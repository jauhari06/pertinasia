<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CetakFormController extends Controller
{
    public function cetakForm(Request $request)
    {
        $data = $request->all();
        $data['mata_kuliah'] = $data['mata_kuliah'] ?? [];
        Carbon::setLocale('id');

        // Ambil tanggal sekarang
        $tanggalSekarang = Carbon::now();

        // Format tanggal dengan nama bulan dalam bahasa Indonesia
        $data['tanggal_sekarang'] = $tanggalSekarang->translatedFormat('d F Y');

        $pdf = PDF::loadView('RPL.cetakFormRpl', compact('data'));
        return $pdf->download('formulir_rpl.pdf');
    }

    public function cetakFormEval(Request $request)
    {
        $data = $request->all();
        Carbon::setLocale('id');

        // Ambil tanggal sekarang
        $tanggalSekarang = Carbon::now();

        // Format tanggal dengan nama bulan dalam bahasa Indonesia
        $data['tanggal_sekarang'] = $tanggalSekarang->translatedFormat('d F Y');

        // Organize data for view
        $data['mata_kuliah'] = [];
        foreach ($request->input('FED_Nomor', []) as $index => $value) {
            $data['mata_kuliah'][] = [
                'FED_Nomor' => $value,
                'Kode_MK' => $request->input('Kode_MK')[$index] ?? '',
                'Nama_MK' => $request->input('Nama_MK')[$index] ?? '',
                'Sks' => $request->input('Sks')[$index] ?? '',
            ];
        }

        $data['evaluasi'] = [];
        foreach ($request->input('Pembelajaran', []) as $index => $value) {
            $data['evaluasi'][] = [
                'Pembelajaran' => $value,
                'keterampilan' => $request->input('keterampilan')[$index] ?? '',
                'Capaian' => $request->input('Capaian')[$index] ?? '',
                'FileBukti' => $request->input('FileBukti')[$index] ?? '',
                'Keterangan' => $request->input('Keterangan')[$index] ?? '',
            ];
        }

        $pdf = PDF::loadView('RPL.cetakFormEval', compact('data'));
        return $pdf->download('formulir_evaluasi.pdf');
    }

    public function cetakFormCV(Request $request)
    {
        $data = $request->all();
        Carbon::setLocale('id');

        // Ambil tanggal sekarang
        $tanggalSekarang = Carbon::now();

        // Format tanggal dengan nama bulan dalam bahasa Indonesia
        $data['tanggal_sekarang'] = $tanggalSekarang->translatedFormat('d F Y');


        // Organize data for view
        $data['pendidikan'] = [];
        foreach ($request->input('nama_sekolah', []) as $index => $value) {
            $data['pendidikan'][] = [
                'no' => $request->input('no_pendidikan')[$index] ?? '',
                'sekolah' => $value,
                'tahun_lulus' => $request->input('tahun_lulus_pendidikan')[$index] ?? '',
                'jurusan' => $request->input('jurusan_program_studi')[$index] ?? '',
            ];
        }

        $data['pelatihan'] = [];
        foreach ($request->input('nama_pelatihan', []) as $index => $value) {
            $data['pelatihan'][] = [
                'tahun' => $request->input('tahun_pelatihan')[$index] ?? '',
                'nama' => $value,
                'penyelenggara' => $request->input('penyelenggara_pelatihan')[$index] ?? '',
                'jangka_waktu' => $request->input('jangka_waktu_pelatihan')[$index] ?? '',
            ];
        }

        $data['seminar'] = [];
        foreach ($request->input('judul_seminar', []) as $index => $value) {
            $data['seminar'][] = [
                'tahun' => $request->input('tahun_seminar')[$index] ?? '',
                'judul' => $value,
                'penyelenggara' => $request->input('penyelenggara_seminar')[$index] ?? '',
                'status' => $request->input('status_keikutsertaan')[$index] ?? '',
            ];
        }

        $data['penghargaan'] = [];
        foreach ($request->input('bentuk_penghargaan', []) as $index => $value) {
            $data['penghargaan'][] = [
                'tahun' => $request->input('tahun_penghargaan')[$index] ?? '',
                'bentuk' => $value,
                'pemberi' => $request->input('pemberi_penghargaan')[$index] ?? '',
            ];
        }

        $data['organisasi'] = [];
        foreach ($request->input('nama_organisasi', []) as $index => $value) {
            $data['organisasi'][] = [
                'tahun' => $request->input('tahun_organisasi')[$index] ?? '',
                'nama' => $value,
                'jabatan' => $request->input('jabatan_organisasi')[$index] ?? '',
            ];
        }

        $data['pekerjaan'] = [];
        foreach ($request->input('nama_alamat_institusi', []) as $index => $value) {
            $data['pekerjaan'][] = [
                'no' => $request->input('no_pekerjaan')[$index] ?? '',
                'institusi' => $value,
                'periode' => $request->input('periode_bekerja')[$index] ?? '',
                'posisi' => $request->input('posisi_jabatan')[$index] ?? '',
                'tugas' => $request->input('uraian_tugas')[$index] ?? '',
            ];
        }

        $data['status_pekerjaan'] = $request->input('status_pekerjaan', '');

        $pdf = PDF::loadView('RPL.cetakFormCV', compact('data'));
        return $pdf->download('formulir_cv.pdf');
    }
}
