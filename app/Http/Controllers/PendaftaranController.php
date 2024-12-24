<?php

namespace App\Http\Controllers;

use App\Models\ms_pendaftaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftaran = ms_pendaftaran::orderBy('tgl', 'DESC')->paginate(10);
        return view('admin.pendaftaran', compact('pendaftaran'));
    }

    public function formPendaftaran()
    {
        return view('pendaftaran');
    }

    public function submitForm(Request $request)
    {
        // Validasi form input
        $request->validate([
            'nama_pts' => 'required|string|max:255',
            'alamat_pts' => 'required|string|max:255',
            'kota_pts' => 'required|string|max:255',
            'pos_pts' => 'required|numeric|digits:5', // Kode pos harus 5 digit
            'thn_berdiri' => 'required|numeric|digits:4', // Tahun harus 4 digit
            'jmlh_prodi' => 'required|numeric',
            'email_pts' => 'required|email|max:255',
            'tlp_pts' => 'required|numeric|digits_between:6,15', // Nomor telepon kantor 6-15 digit
            'fax_pts' => 'nullable|numeric|digits_between:6,15', // Nomor fax 6-15 digit
            'web_pts' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'tmp_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'masa_jbtn' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kode_pos' => 'required|numeric|digits:5', // Kode pos 5 digit
            'tlpn' => 'required|numeric|digits_between:6,15', // Telepon rumah 6-15 digit
            'handphone' => 'required|numeric|digits_between:10,15', // Nomor handphone 10-15 digit
            'email' => 'required|email|max:255',
        ]);


        // Simpan data ke database
        ms_pendaftaran::create([
            'nama_pts' => $request->nama_pts,
            'alamat_pts' => $request->alamat_pts,
            'kota_pts' => $request->kota_pts,
            'pos_pts' => $request->pos_pts,
            'thn_berdiri' => $request->thn_berdiri,
            'jmlh_prodi' => $request->jmlh_prodi,
            'email_pts' => $request->email_pts,
            'tlp_pts' => $request->tlp_pts,
            'fax_pts' => $request->fax_pts,
            'web_pts' => $request->web_pts,
            'nama' => $request->nama,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'masa_jbtn' => $request->masa_jbtn,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'tlpn' => $request->tlpn,
            'handphone' => $request->handphone,
            'email' => $request->email,
            'tgl' => now(),
        ]);

        // Redirect ke halaman sukses
        return response()->json(['success' => true]);
    }

    public function cetakPendaftaran($id)
    {
        // Ambil data pendaftaran berdasarkan ID
        $pendaftaran = ms_pendaftaran::findOrFail($id);

        $tahunnya = Carbon::parse($pendaftaran->tgl)->year;
        // Mengambil data tanggal sekarang
        $tgl_sekarang = now()->format('Y-m-d');

        // Menyiapkan tampilan PDF dengan view yang telah kita buat (lihat langkah berikutnya)
        $pdf = Pdf::loadView('admin.cetak_pendaftaran', compact('pendaftaran', 'tgl_sekarang', 'tahunnya'));

        // Menghasilkan file PDF dan mendownloadnya
        return $pdf->download('Cetak_Pendaftaran_' . $pendaftaran->nama . '.pdf');
    }

    public function updatePendaftaran(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nama_pts' => 'required|string|max:255',
            'alamat_pts' => 'required|string|max:255',
            'kota_pts' => 'required|string|max:255',
            'pos_pts' => 'required|string|max:10',
            'thn_berdiri' => 'required|integer',
            'jmlh_prodi' => 'required|integer',
            'email_pts' => 'required|email|max:255',
            'tlp_pts' => 'required|string|max:15',
            'fax_pts' => 'nullable|string|max:15',
            'web_pts' => 'nullable|string|max:255',
            'nama' => 'required|string|max:255',
            'tmp_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'masa_jbtn' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'tlpn' => 'required|string|max:15',
            'handphone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        // Cari data pendaftaran berdasarkan ID
        $pendaftaran = ms_pendaftaran::findOrFail($id);

        // Update data pendaftaran dengan data yang diterima dari form
        $pendaftaran->update($request->all());

        // Simpan perubahan dan redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data pendaftaran berhasil diperbarui.');
    }

    public function destroyPendaftaran($id)
    {
        $pendaftaran = ms_pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->back()->with('success', 'Pendaftaran berhasil dihapus');
    }

    public function search(Request $request)
    {
        $key = $request->input('key');
        $pendaftaran = ms_pendaftaran::where('nama_pts', 'like', "%{$key}%")
            ->orWhere('alamat_pts', 'like', "%{$key}%")
            ->orWhere('nama', 'like', "%{$key}%")
            ->paginate(10);

        return view('admin.pendaftaran', compact('pendaftaran', 'key'));
    }
}
