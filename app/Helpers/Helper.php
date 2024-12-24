<?php

namespace App\Helpers;

class Helper
{
    public static function limitHtml($text, $limit)
    {
        // Hilangkan entitas HTML &nbsp; dan &quot;
        $text = str_replace(['&nbsp;', '&quot;'], [' ', '"'], $text);

        // Decode entitas HTML tanpa menghapus tag HTML
        $text = htmlspecialchars_decode($text);

        // Tentukan tag HTML yang diizinkan
        $allowedTags = '<p><a><strong><em><u><br><img>';

        // Ambil teks terlebih dahulu sebelum URL gambar
        $textOnly = strip_tags($text);
        if (strlen($textOnly) <= $limit) {
            return $text; // Jika teks lebih pendek dari batas, kembalikan teks asli
        }

        // Jika teks lebih panjang dari batas, potong teks
        $text = substr($textOnly, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' ')) . '...';

        return $text;
    }

    public static function addImageOnError($html)
    {
        return preg_replace(
            '/<img(.*?)src=["\'](.*?)["\'](.*?)>/i',
            '<img$1src="$2"$3 onerror="this.onerror=null; this.src=\'/img/no-image.png\';">',
            $html
        );
    }

    public static function highlight($text, $keyword)
    {
        if (!$keyword) {
            return $text;
        }
        return preg_replace('/(' . preg_quote($keyword, '/') . ')/i', '<span class="highlight">$1</span>', $text);
    }
}
