<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sesi;
use App\Models\counter;
use App\Models\user_online; // Gunakan model yang sudah ada
use Carbon\Carbon;

class CounterController extends Controller
{
    public function countVisitor(Request $request)
    {
        $sessionId = $request->session()->getId();
        $today = Carbon::today();

        // Cek apakah sesi sudah ada
        $existingSession = sesi::where('sesi', $sessionId)->first();

        // Jika sesi belum ada, buat entri baru
        if (!$existingSession) {
            sesi::create(['sesi' => $sessionId]);

            // Cek atau buat entri counter untuk hari ini
            $existingCounter = counter::firstOrNew(['tgl' => $today]);

            // Increment jumlah pengunjung
            $existingCounter->jml_pengunjung = isset($existingCounter->jml_pengunjung) ? $existingCounter->jml_pengunjung + 1 : 1;
            $existingCounter->save(); // Simpan entri counter
        }

        // Pengelolaan user online
        $this->manageUserOnline($sessionId);
    }

    private function manageUserOnline($sessionId)
    {
        $timestamp = Carbon::now()->timestamp;
        $timeout = 600; // 10 menit

        // Cek apakah sesi sudah ada di user_online
        $existingUserOnline = user_online::where('session_id', $sessionId)->first();

        if (!$existingUserOnline) {
            // Jika sesi belum ada, buat entri baru
            user_online::create(['session_id' => $sessionId, 'timestamp' => $timestamp]);
        } else {
            // Jika sesi sudah ada, update timestamp
            $existingUserOnline->timestamp = $timestamp;
            $existingUserOnline->save();
        }

        // Menghapus sesi yang sudah kadaluwarsa
        user_online::where('timestamp', '<', $timestamp - $timeout)->delete();
    }
}

