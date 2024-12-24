<?php
namespace App\Traits;

trait ImageAccesible {
    public function isImageAccessible($url) {
        $headers = @get_headers($url);
        return $headers && strpos($headers[0], '200') !== false; // Cek apakah status 200 OK
    }
}
