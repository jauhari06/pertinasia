<?php

namespace App\Http\Controllers;

use App\Models\ms_berita;
use App\Models\ms_kategoriberita;
use App\Models\ms_fileberita;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;


class BeritaController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->input('search');
        if ($keyword) {
            $berita = ms_berita::where('aktif', 1)
                ->where(function ($query) use ($keyword) {
                    $query->where('judul', 'like', "%{$keyword}%")
                        ->orWhere('deskripsi', 'like', "%{$keyword}%");
                })
                ->orderBy('tgl_jam_publish', 'desc')
                ->paginate(6);
        } else {
            $berita = ms_berita::where('aktif', 1)
                ->orderBy('tgl_jam_publish', 'desc')->paginate(6);
        }

        $berita->transform(function ($item) {
            preg_match('/<img[^>]+src=["\']([^"\'>]+)["\']/', $item->deskripsi, $match);
            $item->image_url = $match[1] ?? null;
            $item->deskripsi = html_entity_decode($item->deskripsi);
            $item->deskripsi = Helper::addImageOnError($item->deskripsi);
            return $item;
        });

        $trendingPosts = ms_berita::where('aktif', 1)
            ->orderBy('viewer', 'desc')->take(5)->get();
        $trendingPosts->transform(function ($item) {
            preg_match('/<img[^>]+src=["\']([^"\'>]+)["\']/', $item->deskripsi, $match);
            $item->image_url = $match[1] ?? null;
            $item->deskripsi = html_entity_decode($item->deskripsi);
            $item->deskripsi = Helper::addImageOnError($item->deskripsi);
            return $item;
        });

        return view('berita', compact('berita', 'trendingPosts'));
    }

    public function berita_detail($id)
    {
        $berita = ms_berita::findOrFail($id);
        $berita->increment('viewer');

        $berita->deskripsi = html_entity_decode($berita->deskripsi);
        $berita->deskripsi = Helper::addImageOnError($berita->deskripsi);

        $recentPosts = ms_berita::where('aktif', 1)
            ->orderBy('tgl_jam_publish', 'desc')->take(8)->get();
        $recentPosts->transform(function ($item) {
            preg_match('/<img[^>]+src=["\']([^"\'>]+)["\']/', $item->deskripsi, $match);
            $item->image_url = $match[1] ?? null;
            $item->deskripsi = html_entity_decode($item->deskripsi);
            $item->deskripsi = Helper::addImageOnError($item->deskripsi);
            return $item;
        });

        return view('berita_detail', compact('berita', 'recentPosts'));
    }

    public function kategori()
    {
        $kategoriBerita = ms_kategoriberita::paginate(10);
        return view('admin.kategori_berita', compact('kategoriBerita'));
    }

    // Controller
    public function allberita(Request $request)
    {
        $selectedKategori = $request->input('id_kategori');

        $query = ms_berita::with('kategori')->orderBy('tgl_jam_publish', 'DESC'); // Menggunakan tgl_jam_publish untuk pengurutan

        // Apply category filter if selected
        if ($selectedKategori) {
            $query->where('id_kategori', $selectedKategori);
        }

        $berita = $query->paginate(10);
        $kategori = ms_kategoriberita::where('aktif', '1')->get(); // No need to paginate categories

        $berita->getCollection()->transform(function ($item) {
            preg_match('/<img[^>]+src=["\']([^"\']+)["\']/', $item->deskripsi, $match);
            $item->image_url = $match[1] ?? null;
            $item->deskripsi = str_replace(['&nbsp;', '&quot;'], [' ', '"'], $item->deskripsi);
            $item->deskripsi = htmlspecialchars_decode($item->deskripsi);
            return $item;
        });

        return view('admin.daftar_berita', compact('berita', 'kategori', 'selectedKategori'));
    }

    public function createBerita(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'judul' => 'required|string|max:255',
                'id_kategori' => 'required|exists:ms_kategoriberita,id',
                'deskripsi' => 'required',
                'file.*' => 'nullable|file|mimes:jpg,png,pdf|max:2048', // Validasi untuk setiap file
            ]);

            $berita = new ms_berita();
            $berita->judul = $request->input('judul');
            $berita->deskripsi = $request->input('deskripsi');
            $berita->tgl_jam = now();
            $berita->tgl_jam_publish = $berita->tgl_jam;
            $berita->id_kategori = $request->input('id_kategori');
            $berita->aktif = $request->input('aktif', 1);
            $berita->tipe = 'eksternal';
            $berita->viewer = 0;
            $berita->id_menu = 0;

            $berita->save();

            // Proses setiap file jika ada file yang diunggah
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = 'uploads/berita_files/' . $fileName;
                    $file->move(public_path('uploads/berita_files'), $fileName);

                    // Simpan detail file ke dalam ms_fileberita
                    $fileBerita = new ms_fileberita();
                    $fileBerita->id_berita = $berita->id;
                    $fileBerita->nama_file = $fileName;
                    $fileBerita->file = $filePath;
                    $fileBerita->save();
                }
            }

            return redirect()->back()->with('success', 'Berita berhasil ditambahkan');
        }

        $kategori = ms_kategoriberita::where('aktif', '1')->get();
        return view('admin.create_berita', compact('kategori'));
    }


    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->upload->extension();
        $request->upload->move(public_path('img/ckeditor_image'), $imageName);

        $url = '/img/ckeditor_image/' . $imageName;
        $funcNum = $request->input('CKEditorFuncNum'); // ambil CKEditorFuncNum dari request

        // Mengembalikan respons dalam bentuk JavaScript untuk CKEditor
        $script = "<script>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '');</script>";

        return response($script)->header('Content-Type', 'text/html');
    }


    public function editBerita($id)
    {
        $berita = ms_berita::findOrFail($id);
        $kategori = ms_kategoriberita::where('aktif', '1')->get();
        return view('admin.update_berita', compact('berita', 'kategori'));
    }

    public function updateBerita(Request $request, $id)
    {
        // Validasi
        $request->validate([
            'judul' => 'required|string|max:255',
            'id_kategori' => 'required|exists:ms_kategoriberita,id',
            'deskripsi' => 'required',
            'file.*' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $berita = ms_berita::findOrFail($id);

        // Ambil daftar gambar lama dari deskripsi lama
        preg_match_all('/src="\/img\/ckeditor_image\/([^"]+)"/', $berita->deskripsi, $oldImages);

        // Cek gambar yang tidak ada di deskripsi baru
        preg_match_all('/src="\/img\/ckeditor_image\/([^"]+)"/', $request->input('deskripsi'), $newImages);
        $imagesToDelete = array_diff($oldImages[1], $newImages[1]);

        // Hapus gambar yang sudah tidak ada dalam deskripsi
        foreach ($imagesToDelete as $image) {
            $imagePath = public_path("img/ckeditor_image/$image");
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Update data berita
        $berita->judul = $request->input('judul');
        $berita->deskripsi = $request->input('deskripsi');
        $berita->id_kategori = $request->input('id_kategori');
        $berita->tgl_jam = now();

        // Jika ada file baru, hapus file lama dan simpan file baru
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = 'uploads/berita_files/' . $fileName;
                $file->move(public_path('uploads/berita_files'), $fileName);

                ms_fileberita::create([
                    'id_berita' => $berita->id,
                    'nama_file' => $file->getClientOriginalName(),
                    'file' => $filePath,
                ]);
            }
        }

        $berita->save();
        return redirect()->back()->with('success', 'Berita berhasil diupdate');
    }

    public function destroyBerita($id)
    {
        $berita = ms_berita::findOrFail($id);

        // Delete associated files
        foreach ($berita->fileberita as $file) {
            $filePath = public_path($file->file);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $file->delete();
        }

        // Delete associated images from deskripsi
        preg_match_all('/src="\/img\/ckeditor_image\/([^"]+)"/', $berita->deskripsi, $images);
        foreach ($images[1] as $image) {
            $imagePath = public_path("img/ckeditor_image/$image");
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $berita->delete();
        return redirect()->back()->with('success', 'Berita berhasil dihapus');
    }

    public function toggleAktifBerita($id)
    {
        $berita = ms_berita::findOrFail($id);
        $berita->aktif = $berita->aktif == 1 ? 0 : 1;
        $berita->save();

        return redirect()->back()->with('success', 'Status berita berhasil diperbarui');
    }

    public function createKategori(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
            ]);

            $kategori = new ms_kategoriberita();
            $kategori->nama_kategori = $request->input('nama_kategori');
            $kategori->tipe = 'eksternal';
            $kategori->aktif = $request->input('aktif', 1);
            $kategori->save();

            return redirect()->route('admin.kategori-berita')->with('success', 'Kategori berhasil ditambahkan');
        }

        return view('admin.create_kategori');
    }

    public function editKategori($id)
    {
        $kategoriBerita = ms_kategoriberita::findOrFail($id);
        return view('admin.update_kategori-berita', compact('kategoriBerita'));
    }

    public function updateKategori(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = ms_kategoriberita::findOrFail($id);
        $kategori->nama_kategori = $request->input('nama_kategori');
        $kategori->save();

        return redirect()->route('admin.kategori-berita')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroyKategori($id)
    {
        $kategori = ms_kategoriberita::findOrFail($id);
        $kategori->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }

    public function toggleAktifKategori($id)
    {
        $kategori = ms_kategoriberita::findOrFail($id);
        $kategori->aktif = $kategori->aktif == 1 ? 0 : 1;
        $kategori->save();

        return redirect()->back()->with('success', 'Status kategori berhasil diperbarui');
    }

    public function searchKategori(Request $request)
    {
        $key = $request->input('key');

        // Pencarian pada tabel ms_album
        $kategoriBerita = ms_kategoriberita::where('nama_kategori', 'like', "%{$key}%")
            ->orWhere('nama_kategori_en', 'like', "%{$key}%")
            ->paginate(10);


        return view('admin.kategori_berita', compact('kategoriBerita', 'key'));
    }

    public function searchBerita(Request $request)
    {
        $key = $request->input('key');

        // Pencarian pada tabel ms_berita
        $berita = ms_berita::where('judul', 'like', "%{$key}%")
            ->orWhere('judul_en', 'like', "%{$key}%")
            ->orWhere('deskripsi', 'like', "%{$key}%")
            ->orWhere('deskripsi_en', 'like', "%{$key}%")
            ->paginate(10);

        $kategori = ms_kategoriberita::where('aktif', '1')->get();



        return view('admin.daftar_berita', compact('berita', 'kategori', 'key'));
    }
}
