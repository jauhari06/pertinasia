<?php

namespace App\Http\Controllers;

use App\Models\ms_foto;
use App\Models\ms_video;
use App\Models\ms_album;
use App\Models\ms_link;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MediaController extends Controller
{
    public function index()
    {
        $albums = ms_album::where('aktif', 1)->get();
        $fotos = ms_foto::where('aktif', 1)->get();
        $video = ms_video::where('aktif', 1)->get();
        $link = ms_link::where('aktif', 1)->get();
        return view('media', compact('albums', 'fotos', 'video', 'link'));
    }
    public function album()
    {
        $album = ms_album::paginate(10);
        return view('admin.album', compact('album'));
    }
    public function foto(Request $request)
    {
        $query = ms_foto::with('album');

        // Filter by album if selected
        if ($request->filled('id_album')) {
            $query->where('id_album', $request->id_album);
        }

        $foto = $query->paginate(4);
        $allAlbum = ms_album::where('aktif', 1)->get();

        return view('admin.all_foto', compact('foto', 'allAlbum'));
    }
    public function video()
    {
        $video = ms_video::paginate(10);
        return view('admin.video', compact('video'));
    }

    public function showFoto($id)
    {
        $album = ms_album::findOrFail($id);
        $foto = $album->foto;
        $allAlbum = ms_album::all();
        return view('admin.foto', compact('foto', 'album', 'allAlbum'));
    }

    public function createVideo(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'judul' => 'required|string|max:100',
                'link' => 'required|string|max:100',
            ]);

            $video = new ms_video();
            $video->judul = $request->input('judul');
            $video->judul_en = '';
            $video->link = $request->input('link');
            $video->aktif = $request->input('aktif', 1);
            $video->save();

            return redirect()->route('admin.video')->with('success', 'Album berhasil ditambahkan');
        }

        return view('admin.create_video');
    }

    public function editVideo($id)
    {
        $video = ms_video::findOrFail($id);
        return view('admin.update_video', compact('video'));
    }

    public function updateVideo(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:100',
            'link' => 'required|string|max:100',
        ]);

        $video = ms_video::findOrFail($id);
        $video->judul = $request->input('judul');
        $video->link = $request->input('link');
        $video->save();

        return redirect()->route('admin.video')->with('success', 'Video berhasil diupdate');
    }

    public function destroyVideo($id)
    {
        $video = ms_video::findOrFail($id);
        $video->delete();

        return redirect()->back()->with('success', 'Video berhasil dihapus');
    }
    public function createAlbum(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nama_album' => 'required|string|max:255',
            ]);

            $album = new ms_album();
            $album->nama_album = $request->input('nama_album');
            $album->aktif = $request->input('aktif', 1);
            $album->save();

            return redirect()->route('admin.album')->with('success', 'Album berhasil ditambahkan');
        }

        return view('admin.create_album');
    }

    public function editAlbum($id)
    {
        $album = ms_album::findOrFail($id);
        return view('admin.update_album', compact('album'));
    }

    public function updateAlbum(Request $request, $id)
    {
        $request->validate([
            'nama_album' => 'required|string|max:255',
        ]);

        $album = ms_album::findOrFail($id);
        $album->nama_album = $request->input('nama_album');
        $album->save();

        return redirect()->route('admin.album')->with('success', 'Album berhasil diupdate');
    }

    public function destroyAlbum($id)
    {
        $album = ms_album::findOrFail($id);
        $album->delete();

        return redirect()->back()->with('success', 'Album berhasil dihapus');
    }
    public function createOrStoreFoto(Request $request)
    {
        if ($request->isMethod('post')) {
            try {
                // Debug request
                Log::info('Request data:', $request->all());
                Log::info('Files:', $request->allFiles());

                // Common validation
                $request->validate([
                    'upload_type' => 'required|in:single_upload,multiple_upload',
                    'id_album' => 'nullable|exists:ms_album,id',
                ]);

                // Validate single upload first as it's required
                $request->validate([
                    'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'keterangan' => 'required|string',
                ]);

                // Handle single upload
                $singleFile = $request->file('foto');
                $singleFileName = time() . '_single_' . $singleFile->getClientOriginalName();
                $singleFile->move(public_path('img/galeri_foto/'), $singleFileName);

                // Create single upload record
                ms_foto::create([
                    'foto' => $singleFileName,
                    'keterangan' => $request->keterangan,
                    'keterangan_en' => '',
                    'id_album' => $request->id_album,
                    'aktif' => 1,
                ]);

                // Handle multiple upload if exists and single upload is present
                if ($request->upload_type === 'multiple_upload' && $request->hasFile('foto') && $request->hasFile('fotos')) {
                    foreach ($request->file('foto_multiple') as $index => $file) {
                        $multipleFileName = time() . '_multiple_' . $index . '_' . $file->getClientOriginalName();
                        $file->move(public_path('img/galeri_foto/'), $multipleFileName);

                        ms_foto::create([
                            'foto' => $multipleFileName,
                            'keterangan' => null,
                            'keterangan_en' => '',
                            'id_album' => $request->id_album,
                            'aktif' => 1,
                        ]);
                    }
                }

                return redirect()->route('admin.all-foto')
                    ->with('success', 'Foto berhasil diunggah');
            } catch (\Exception $e) {
                Log::error('Upload error: ' . $e->getMessage());
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal mengunggah foto: ' . $e->getMessage());
            }
        }

        $allAlbum = ms_album::where('aktif', 1)->get();
        return view('admin.create_foto', compact('allAlbum'));
    }

    public function editFoto($id)
    {
        $foto = ms_foto::findOrFail($id);
        $allAlbum = ms_album::where('aktif', 1)->get();
        return view('admin.update_foto', compact('foto', 'allAlbum'));
    }

    public function updateFoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'keterangan' => 'nullable|string|max:255',
            'id_album' => 'nullable|exists:ms_album,id',
        ]);

        $foto = ms_foto::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($foto->foto) {
                $oldFilePath = public_path('img/galeri_foto/' . $foto->foto);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/galeri_foto/'), $fileName);
            $foto->foto = $fileName;
        }

        if ($request->has('keterangan')) {
            $foto->keterangan = $request->keterangan;
        }

        if ($request->has('id_album')) {
            $foto->id_album = $request->id_album;
        }

        $foto->keterangan = $request->keterangan;
        $foto->id_album = $request->id_album;
        $foto->save();

        return redirect()->back()->with('success', 'Foto berhasil diperbarui.');
    }

    public function deleteFoto($id)
    {
        $foto = ms_foto::findOrFail($id);

        if ($foto->foto) {
            $filePath = public_path('img/galeri_foto/' . $foto->foto);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $foto->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }

    public function toggleAktifAlbum($id)
    {
        $album = ms_album::findOrFail($id);
        $album->aktif = !$album->aktif;
        $album->save();

        return redirect()->back()->with('success', 'Status album berhasil diubah.');
    }

    public function toggleAktifFoto($id)
    {
        $foto = ms_foto::findOrFail($id);
        $foto->aktif = !$foto->aktif;
        $foto->save();

        return redirect()->back()->with('success', 'Status foto berhasil diubah.');
    }

    public function toggleAktifVideo($id)
    {
        $video = ms_video::findOrFail($id);
        $video->aktif = !$video->aktif;
        $video->save();

        return redirect()->back()->with('success', 'Status video berhasil diubah.');
    }

    public function searchAlbum(Request $request)
    {
        $key = $request->input('key');

        // Pencarian pada tabel ms_album
        $album = ms_album::where('nama_album', 'like', "%{$key}%")
            ->orWhere('nama_album_en', 'like', "%{$key}%")
            ->paginate(10);

        return view('admin.album', compact('album', 'key'));
    }

    public function searchFoto(Request $request)
    {
        $key = $request->input('key');

        // Pencarian pada tabel ms_foto dan relasi dengan ms_album
        $foto = ms_foto::with('album')
            ->where('keterangan', 'like', "%{$key}%")
            ->orWhere('keterangan_en', 'like', "%{$key}%")
            ->orWhereHas('album', function ($query) use ($key) {
                $query->where('nama_album', 'like', "%{$key}%")
                    ->orWhere('nama_album_en', 'like', "%{$key}%");
            })
            ->paginate(10);
        $allAlbum = ms_album::where('aktif', 1)->get();

        return view('admin.all_foto', compact('foto', 'key', 'allAlbum'));
    }
}
