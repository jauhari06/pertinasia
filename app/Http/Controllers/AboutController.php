<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ms_content;
use App\Models\ms_menu;

class AboutController extends Controller
{
    public function index()
    {
        $risalah = ms_content::with('menu')->whereHas('menu', function ($query) {
            $query->where('id', 552);
        })->where('aktif', 1)->get();

        $risalah->transform(function ($item) {
            $item->deskripsi = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $item->deskripsi);
            $item->deskripsi = strip_tags($item->deskripsi, '<p><a><b><i><u><strong><em><br><ul><ol><li><style>');
            return $item;
        });

        return view('about', compact('risalah',));
    }
    // Controller
    public function risalah(Request $request)
    {
        $risalah = ms_content::with('menu')
            ->whereHas('menu', function ($query) {
                $query->where('id', 552);
            })
            ->paginate(10); // Change number as needed

        // Transform collection items after pagination
        foreach ($risalah->items() as $item) {
            $item->deskripsi = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $item->deskripsi);
            $item->deskripsi = strip_tags($item->deskripsi, '<p><a><b><i><u><strong><em><br><ul><ol><li><style>');
        }

        return view('admin.risalah', compact('risalah'));
    }

    public function createRisalah(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'deskripsi' => 'required|string|max:255',
            ]);

            $risalah = new ms_content();
            $risalah->deskripsi = $request->input('deskripsi');
            $risalah->deskripsi_en = '';
            $risalah->id_menu = 552;
            $risalah->aktif = $request->input('aktif', 1);
            $risalah->save();

            return redirect()->route('admin.risalah')->with('success', 'Risalah berhasil ditambahkan');
        }

        return view('admin.create_risalah');
    }

    public function editRisalah($id)
    {
        $risalah = ms_content::findOrFail($id);
        return view('admin.update_risalah', compact('risalah'));
    }

    public function updateRisalah(Request $request, $id)
    {
        $request->validate([
            'deskripsi' => 'required|string|max:100',
        ]);

        $risalah = ms_content::findOrFail($id);
        $risalah->deskripsi = $request->input('deskripsi');
        $risalah->save();

        return redirect()->route('admin.risalah')->with('success', 'Risalah berhasil diupdate');
    }

    public function destroyRisalah($id)
    {
        $risalah = ms_content::findOrFail($id);
        $risalah->delete();

        return redirect()->back()->with('success', 'Risalah berhasil dihapus');
    }

    public function renstra()
    {
        $renstra = ms_content::with('menu')->whereHas('menu', function ($query) {
            $query->where('id', 558);
        })->paginate(10); // Ganti '10' sesuai jumlah item per halaman yang diinginkan

        $renstra->transform(function ($item) {
            $item->deskripsi = str_replace(' ', '%20', $item->deskripsi);

            if (filter_var($item->deskripsi, FILTER_VALIDATE_URL)) {
                $item->deskripsi = '<a href="' . $item->deskripsi . '" target="_blank">' . $item->deskripsi . '</a>';
            }

            $item->deskripsi = strip_tags($item->deskripsi, '<p><a><b><i><u><strong><em><br><ul><ol><li><style>');
            return $item;
        });

        return view('admin.renstra', compact('renstra'));
    }

    public function createRenstra(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'deskripsi' => 'required|string|max:255',
            ]);

            $risalah = new ms_content();
            $risalah->deskripsi = $request->input('deskripsi');
            $risalah->deskripsi_en = '';
            $risalah->id_menu = 558;
            $risalah->aktif = $request->input('aktif', 1);
            $risalah->save();

            return redirect()->route('admin.renstra')->with('success', 'Renstra berhasil ditambahkan');
        }

        return view('admin.create_renstra');
    }

    public function editRenstra($id)
    {
        $renstra = ms_content::findOrFail($id);
        return view('admin.update_renstra', compact('renstra'));
    }
    public function updateRenstra(Request $request, $id)
    {
        $request->validate([
            'deskripsi' => 'required|string|max:100',
        ]);

        $risalah = ms_content::findOrFail($id);
        $risalah->deskripsi = $request->input('deskripsi');
        $risalah->save();

        return redirect()->route('admin.renstra')->with('success', 'Renstra berhasil diupdate');
    }

    public function destroyRenstra($id)
    {
        $risalah = ms_content::findOrFail($id);
        $risalah->delete();

        return redirect()->back()->with('success', 'Renstra berhasil dihapus');
    }

    public function legalitas()
    {
        $legalitas = ms_content::with('menu')
            ->whereHas('menu', function ($query) {
                $query->where('id', 553);
            })
            ->paginate(10); // Change number as needed

        // Transform collection items after pagination
        $legalitas->getCollection()->transform(function ($item) {
            $item->deskripsi = str_replace(' ', '%20', $item->deskripsi);

            if (filter_var($item->deskripsi, FILTER_VALIDATE_URL)) {
                $item->deskripsi = '<a href="' . $item->deskripsi . '" target="_blank">' . $item->deskripsi . '</a>';
            }

            $item->deskripsi = strip_tags($item->deskripsi, '<p><a><b><i><u><strong><em><br><ul><ol><li><style>');
            return $item;
        });

        return view('admin.legalitas', compact('legalitas'));
    }

    public function createLegalitas(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'deskripsi' => 'required|string|max:255',
            ]);

            $risalah = new ms_content();
            $risalah->deskripsi = $request->input('deskripsi');
            $risalah->deskripsi_en = '';
            $risalah->id_menu = 553;
            $risalah->aktif = $request->input('aktif', 1);
            $risalah->save();

            return redirect()->back()->with('success', 'Legalitas berhasil ditambahkan');
        }

        return view('admin.create_Legalitas');
    }

    public function editLegalitas($id)
    {
        $legalitas = ms_content::findOrFail($id);
        return view('admin.update_legalitas', compact('legalitas'));
    }

    public function updateLegalitas(Request $request, $id)
    {
        $request->validate([
            'deskripsi' => 'required|string|max:100',
        ]);

        $risalah = ms_content::findOrFail($id);
        $risalah->deskripsi = $request->input('deskripsi');
        $risalah->save();

        return redirect()->route('admin.legalitas')->with('success', 'Legalitas berhasil diupdate');
    }

    public function destroyLegalitas($id)
    {
        $risalah = ms_content::findOrFail($id);
        $risalah->delete();

        return redirect()->back()->with('success', 'Legalitas berhasil dihapus');
    }

    public function toggleAktifRisalah($id)
    {
        $risalah = ms_content::findOrFail($id);
        $risalah->aktif = !$risalah->aktif;
        $risalah->save();

        return redirect()->back()->with('success', 'Status risalah berhasil diubah.');
    }

    public function toggleAktifRenstra($id)
    {
        $renstra = ms_content::findOrFail($id);
        $renstra->aktif = !$renstra->aktif;
        $renstra->save();

        return redirect()->back()->with('success', 'Status renstra berhasil diubah.');
    }
    public function toggleAktifLegalitas($id)
    {
        $legalitas = ms_content::findOrFail($id);
        $legalitas->aktif = !$legalitas->aktif;
        $legalitas->save();

        return redirect()->back()->with('success', 'Status legalitas berhasil diubah.');
    }

    public function searchRisalah(Request $request)
    {
        $key = $request->input('key');

        $risalah = ms_content::where('id_menu', 552)
            ->where(function ($query) use ($key) {
                $query->where('deskripsi', 'like', "%{$key}%")
                    ->orWhere('deskripsi_en', 'like', "%{$key}%");
            })
            ->paginate(10);

        return view('admin.risalah', compact('risalah', 'key'));
    }

    public function searchRenstra(Request $request)
    {
        $key = $request->input('key');

        $renstra = ms_content::where('id_menu', 558)
            ->where(function ($query) use ($key) {
                $query->where('deskripsi', 'like', "%{$key}%")
                    ->orWhere('deskripsi_en', 'like', "%{$key}%");
            })
            ->paginate(10);

        return view('admin.renstra', compact('renstra', 'key'));
    }

    public function searchlegalitas(Request $request)
    {
        $key = $request->input('key');

        $legalitas = ms_content::where('id_menu', 553)
            ->where(function ($query) use ($key) {
                $query->where('deskripsi', 'like', "%{$key}%")
                    ->orWhere('deskripsi_en', 'like', "%{$key}%");
            })
            ->paginate(10);

        return view('admin.legalitas', compact('legalitas', 'key'));
    }
}
