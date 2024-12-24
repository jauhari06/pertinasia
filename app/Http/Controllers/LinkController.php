<?php

namespace App\Http\Controllers;

use App\Models\ms_link;
use App\Models\ms_linkkategori;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        $alllink = ms_link::with('kategori')->paginate(10);
        $kategoriLink = ms_linkkategori::where('aktif', 1)->paginate(10);
        return view('admin.link', compact('alllink', 'kategoriLink'));
    }

    public function kategori()
    {
        $kategoriLink = ms_linkkategori::paginate(10);
        return view('admin.kategori_link', compact('kategoriLink'));
    }


    public function createKategori(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
            ]);

            $kategori = new ms_linkkategori();
            $kategori->nama_kategori = $request->input('nama_kategori');
            $kategori->nama_kategori_en = '';
            $kategori->aktif = $request->input('aktif', 1);
            $kategori->save();

            return redirect()->route('admin.kategori-link')->with('success', 'Kategori berhasil ditambahkan');
        }

        return view('admin.create_kategori_link');
    }

    public function editKategori($id)
    {
        $kategoriLink = ms_linkkategori::findOrFail($id);
        return view('admin.update_kategori-link', compact('kategoriLink'));
    }

    public function updateKategori(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);

        $kategori = ms_linkkategori::findOrFail($id);
        $kategori->nama_kategori = $request->input('nama_kategori');
        $kategori->save();

        return redirect()->route('admin.kategori-link')->with('success', 'Kategori berhasil diupdate');
    }


    public function destroyKategori($id)
    {
        $kategori = ms_linkkategori::findOrFail($id);
        $kategori->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }

    public function createLink(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nama_link' => 'required|string|max:255',
                'link' => 'required|string|max:255',
                'tipe' => 'nullable|string|max:255',
                'id_kategori' => 'required|integer',
            ]);

            $kategori = new ms_link();
            $kategori->nama_link = $request->input('nama_link');
            $kategori->nama_link_en = '';
            $kategori->link = $request->input('link');
            $kategori->aktif = $request->input('aktif', 1);
            $kategori->id_kategori = $request->input('id_kategori');
            $kategori->save();

            return redirect()->route('admin.link')->with('success', 'Link berhasil ditambahkan');
        }

        $kategoriLink = ms_linkkategori::where('aktif', 1)->get();
        return view('admin.create_link', compact('kategoriLink'));
    }

    public function editLink($id)
    {
        $alllink = ms_link::findOrFail($id);
        $kategoriLink = ms_linkkategori::where('aktif', 1)->get();
        return view('admin.update_link', compact('alllink', 'kategoriLink'));
    }

    public function updateLink(Request $request, $id)
    {
        $request->validate([
            'nama_link' => 'required|string|max:100',
            'link' => 'nullable|string|max:100',
            'id_kategori' => 'nullable|integer|exists:ms_linkkategori,id',
        ]);

        $link = ms_link::findOrFail($id);

        if ($request->filled('nama_link')) {
            $link->nama_link = $request->input('nama_link');
        }
        if ($request->filled('link')) {
            $link->link = $request->input('link');
        }
        if ($request->filled('id_kategori')) {
            $link->id_kategori = $request->input('id_kategori');
        }
        $link->save();

        return redirect()->route('admin.link')->with('success', 'Link berhasil diupdate');
    }


    public function destroyLink($id)
    {
        $kategori = ms_link::findOrFail($id);
        $kategori->delete();

        return redirect()->back()->with('success', 'Link berhasil dihapus');
    }

    public function toggleAktifLink($id)
    {
        $kategori = ms_link::findOrFail($id);
        $kategori->aktif = !$kategori->aktif;
        $kategori->save();

        return redirect()->back()->with('success', 'Status video berhasil diubah.');
    }
    public function toggleAktifKategori($id)
    {
        $kategori = ms_linkkategori::findOrFail($id);
        $kategori->aktif = !$kategori->aktif;
        $kategori->save();

        return redirect()->back()->with('success', 'Status video berhasil diubah.');
    }

    public function searchKategori(Request $request)
    {
        $key = $request->input('key');

        // Pencarian pada tabel ms_album
        $kategoriLink = ms_linkkategori::where('nama_kategori', 'like', "%{$key}%")
            ->orWhere('nama_kategori_en', 'like', "%{$key}%")
            ->paginate(10);

        return view('admin.Kategori_link', compact('kategoriLink', 'key'));
    }

    public function searchLink(Request $request)
    {
        $key = $request->input('key');

        // Pencarian pada tabel ms_album
        $alllink = ms_link::where('nama_link', 'like', "%{$key}%")
            ->orWhere('nama_link_en', 'like', "%{$key}%")
            ->orWhere('link', 'like', "%{$key}%")
            ->orWhere('tipe', 'like', "%{$key}%")
            ->paginate(10);

        return view('admin.link', compact('alllink', 'key'));
    }
}
