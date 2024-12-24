<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ms_menu;
use App\Models\ms_userrole;

class ContentController extends Controller
{
    public function content(Request $request)
    {
        $obj = $request->input('obj');
        $ws = $request->input('ws', ''); // default kosong jika tidak ada

        if (!empty($obj)) {
            // Query untuk mendapatkan menu berdasarkan parameter $obj
            $menu = ms_menu::where('parameter', $obj)->first();

            if (!$menu) {
                return view('errors.404');
            }

            // Query untuk mendapatkan hak akses user berdasarkan id_menu dan tipe user di session
            $role = ms_userrole::where('id_menu', $menu->id)
                ->where('id_tipeuser', session('login-type'))
                ->first();

            // Variabel hak akses
            $tambahRole = $role->tambah ?? 0;
            $hapusRole = $role->hapus ?? 0;
            $editRole = $role->edit ?? 0;
            $statusRole = $role->status ?? 0;

            // Logika untuk subpage dan ws
            if ($menu->subpage === 'Y' && $ws === 'welcome-screen') {
                return view('welcome-screen');
            } elseif ($menu->subpage === 'Y') {
                return view('daftar-bs');
            } else {
                if (!empty($menu->id) && $menu->tipe !== 'custom') {
                    if ($menu->tipe !== 'listurl') {
                        return view('content');
                    } else {
                        return view('listurl');
                    }
                } else {
                    return view($obj);
                }
            }
        } else {
            return view('part-welcome');
        }
    }
}
