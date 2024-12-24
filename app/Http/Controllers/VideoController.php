<?php

namespace App\Http\Controllers;

use App\Models\ms_video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $video = ms_video::all();
        return view('admin.video', compact('video'));
    }

    public function search(Request $request)
    {
        $key = $request->input('key');

        // Pencarian pada tabel ms_album
        $video = ms_video::where('judul', 'like', "%{$key}%")
            ->orWhere('judul_en', 'like', "%{$key}%")
            ->orWhere('link', 'like', "%{$key}%")
            ->paginate(10);


        return view('admin.video', compact('video', 'key'));
    }
}
