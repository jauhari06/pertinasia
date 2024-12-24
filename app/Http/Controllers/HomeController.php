<?php

namespace App\Http\Controllers;

use App\Models\ms_berita;
use App\Models\ms_foto;
use App\Models\ms_video;
use App\Models\ms_link;
use App\Models\banner;
use App\Models\ms_tittlefooter;
use Carbon\Carbon;
use App\Traits\ImageAccesible;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ImageAccesible;
    public function index()
    {
        $banners = banner::where('aktif', 1)
            ->orderBy('urut', 'asc')
            ->get();
        $berita = ms_berita::where('aktif', 1)
            ->orderBy('tgl_jam_publish', 'desc')
            ->take(1)->get();
        $berita->transform(function ($item) {
            preg_match('/<img[^>]+src=["\']([^"\'>]+)["\']/', $item->deskripsi, $match);
            $item->image_url = $match[1] ?? null;
            $item->deskripsi = strip_tags($item->deskripsi);
            return $item;
        });
        $beritaPopuler = ms_berita::where('aktif', 1)
            ->orderBy('viewer', 'desc')
            ->take(4)->get();
        $beritaPopuler->transform(function ($item) {
            preg_match('/<img[^>]+src=["\']([^"\'>]+)["\']/', $item->deskripsi, $match);
            $item->image_url = $match[1] ?? null;
            $item->deskripsi = strip_tags($item->deskripsi);
            return $item;
        });
        $foto = ms_foto::where('aktif', 1)
            ->orderBy('id', 'asc')
            ->take(6)->get();
        $video = ms_video::where('aktif', 1)->get();
        return view('index', compact('banners', 'berita', 'foto', 'video', 'beritaPopuler'));
    }
}
