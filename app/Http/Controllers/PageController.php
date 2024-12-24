<?php

namespace App\Http\Controllers;

use App\Models\page_setting;
use App\Models\ms_meta;
use App\Models\ms_link;
use App\Models\ms_titlefooter;
use App\Models\ms_content;

class PageController extends Controller
{
    public function loadPageData()
    {
        // Ambil setting halaman
        $page_setting = page_setting::first();

        $meta_keywords = ms_meta::where('tipe', 'k')->where('aktif', 1)->first();
        $meta_description = ms_meta::where('tipe', 'd')->where('aktif', 1)->first();

        $link = ms_link::with('kategori')
            ->where('aktif', 1)
            ->whereHas('kategori', function ($query) {
                $query->where('id', 2);
            })
            ->get();
        $title = ms_titlefooter::where('tipe', 't')->where('aktif', 1)->first();
        $footer = ms_titlefooter::where('tipe', 'f')->where('aktif', 1)->first();
        $clean_footer = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $footer->teks);
        $rensta = ms_content::with('menu')->whereHas('menu', function ($query) {
            $query->where('id', 558);
        })->where('aktif', 1)->first();
        $rensta_url = $rensta ? asset('img/' . $rensta->deskripsi) : null;

        $hukum = ms_content::with('menu')->whereHas('menu', function ($query) {
            $query->where('id', 553);
        })->where('aktif', 1)->first();
        $hukum_url = $hukum ? asset('img/' . $hukum->deskripsi) : null;

        // Return data ke view
        return [
            'page_setting' => $page_setting,
            'meta_keywords' => $meta_keywords,
            'meta_description' => $meta_description,
            'link' => $link,
            'title' => $title,
            'footer' => $clean_footer,
            'rensta' => $rensta,
            'rensta_url' => $rensta_url,
            'hukum' => $hukum,
            'hukum_url' => $hukum_url,
        ];
    }
}
