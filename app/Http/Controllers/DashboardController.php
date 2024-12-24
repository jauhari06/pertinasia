<?php

namespace App\Http\Controllers;

use App\Models\ms_berita;
use App\Models\counter;
use App\Models\ms_menu;
use App\Models\usermanager;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\user_online;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $menu = ms_menu::where('shortcut', 'Y')->get();
        $timestamp = Carbon::now()->timestamp;
        $timeout = 600; // 10 minutes
    
        // Count users whose session is still valid (online users)
        $userOnline = user_online::where('timestamp', '>=', $timestamp - $timeout)->count();
    
        $today = Carbon::today();
        $pengunjungHariIni = counter::whereDate('tgl', $today)->sum('jml_pengunjung');
    
        // Mengambil data kemarin
        $kemarin = Carbon::yesterday();
        $pengunjungKemarin = counter::whereDate('tgl', $kemarin)->sum('jml_pengunjung');
    
        // Mengambil data minggu ini (dari awal minggu hingga hari ini)
        $mingguIniStart = Carbon::now()->startOfWeek();
        $mingguIniEnd = Carbon::now()->endOfWeek();
        $pengunjungMingguIni = counter::whereBetween('tgl', [$mingguIniStart, $mingguIniEnd])->sum('jml_pengunjung');
    
        $bulanIniStart = Carbon::now()->startOfMonth();
        $bulanIniEnd = Carbon::now()->endOfMonth();
        $pengunjungBulanIni = counter::whereBetween('tgl', [$bulanIniStart, $bulanIniEnd])->sum('jml_pengunjung');
    
        // Menghitung kunjungan per bulan
        $pengunjungPerBulan = [];
        $totalKunjungan = 0;
        $bulanSekarang  = Carbon::now()->month;
        $tahunDipilih = $request->input('tahun', Carbon::now()->year);
        $tahunList = range(Carbon::now()->year - 10, Carbon::now()->year);
    
        if ($tahunDipilih == Carbon::now()->year) {
            $jumlahBulan = $bulanSekarang;
        } else {
            $jumlahBulan = 12;
        }
    
        for ($bulan = 1; $bulan <= $jumlahBulan; $bulan++) {
            $startOfMonth = Carbon::createFromDate($tahunDipilih, $bulan, 1)->startOfMonth();
            $endOfMonth = Carbon::createFromDate($tahunDipilih, $bulan, 1)->endOfMonth();
            $totalPengunjung = counter::whereBetween('tgl', [$startOfMonth, $endOfMonth])->sum('jml_pengunjung');
            $totalKunjungan += $totalPengunjung;
            $pengunjungPerBulan[$bulan] = $totalPengunjung;
        }
    
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        if ($startDate && $endDate) {
            $pengunjung = counter::whereBetween('tgl', [$startDate, $endDate])->get();
    
            // Jika tidak ada data dalam rentang yang dipilih, kirimkan data kosong
            if ($pengunjung->isEmpty()) {
                return response()->json([
                    'date' => [],
                    'viewer' => []
                ]);
            }
        } else {
            // Jika tidak ada date range yang dipilih, gunakan default 30 hari terakhir
            $startDate = now()->subDays(30)->toDateString();
            $endDate = now()->toDateString();
            $pengunjung = counter::whereBetween('tgl', [$startDate, $endDate])->get();
        }
        $date = $pengunjung->pluck('tgl')->toArray();
        $viewer = $pengunjung->pluck('jml_pengunjung')->toArray();
    
        if ($request->ajax()) {
            // Kirimkan data dalam bentuk JSON untuk digunakan oleh JavaScript
            return response()->json([
                'date' => $date,
                'viewer' => $viewer
            ]);
        }

        $menu = $menu->map(function ($item) {
            $item->route = $this->getRouteForMenu($item->nama_menu);
            return $item;
        });
    
        $berita = ms_berita::orderBy('viewer', 'desc')->take(3)->get();
        $warna = ["bg-green", "bg-blue", "bg-yellow", "bg-red"];
    
        return view('admin.index', compact('berita', 'pengunjung', 'date', 'viewer', 'startDate', 'endDate', 'menu', 'pengunjungHariIni', 'pengunjungKemarin', 'pengunjungMingguIni', 'pengunjungBulanIni', 'pengunjungPerBulan', 'totalKunjungan', 'tahunDipilih', 'tahunList', 'userOnline', 'warna'));
    }
    
    private function getRouteForMenu($menuName)
    {
        $routes = [
            'Dashboard' => 'admin.dashboard',
            'Kategori Berita' => 'admin.kategori-berita',
            'Daftar Berita' => 'admin.berita',
            'Album' => 'admin.album',
            'Foto' => 'admin.all-foto',
            'Video' => 'admin.video',
            'Kategori Link' => 'admin.kategori-link',
            'Daftar Link' => 'admin.link',
            'Pendaftaran' => 'admin.pendaftaran',
            'Risalah' => 'admin.risalah',
            'Renstra & Renop' => 'admin.renstra',
            'Legalitas' => 'admin.legalitas',
            'Sekretariat' => '#', // Placeholder for undefined route
            'Pengurus' => '#', // Placeholder for undefined route
            'Banner' => 'admin.banner',
            'User Role' => 'admin.role',
            'User Manager' => 'admin.usermanager',
            'Menu' => 'admin.menu',
            'Title' => 'admin.title',
            'Permalink' => '#',
            'Limit Berita' => 'admin.limitberita',
            'Footer' => 'admin.footer',
            'Keyword' => 'admin.keyword',
            'Description' => 'admin.description',
            'Create Kategori Berita' => 'admin.create-kategori-berita',
            'Update Kategori Berita' => 'kategori-berita.update',
            'Destroy Kategori Berita' => 'kategori-berita.destroy',
            'Toggle Aktif Kategori Berita' => 'kategori-berita.toggleAktif',
            'Create Berita' => 'admin.berita.create',
            'Update Berita' => 'berita.update',
            'Destroy Berita' => 'berita.destroy',
            'Toggle Aktif Berita' => 'berita.toggleAktif',
            'Create Album' => 'admin.album.create',
            'Update Album' => 'album.update',
            'Destroy Album' => 'album.delete',
            'Toggle Aktif Album' => 'album.toggleAktif',
            'Show Foto' => 'album.foto',
            'Create Foto' => 'admin.foto.create',
            'Update Foto' => 'foto.update',
            'Delete Foto' => 'foto.delete',
            'Toggle Aktif Foto' => 'foto.toggleAktif',
            'Create Video' => 'admin.video.create',
            'Update Video' => 'video.update',
            'Destroy Video' => 'video.delete',
            'Toggle Aktif Video' => 'video.toggleAktif',
            'Create Risalah' => 'admin.create-risalah',
            'Update Risalah' => 'admin.update-risalah',
            'Destroy Risalah' => 'admin.delete-risalah',
            'Toggle Aktif Risalah' => 'risalah.toggleAktif',
            'Create Renstra' => 'admin.create-renstra',
            'Update Renstra' => 'admin.update-renstra',
            'Destroy Renstra' => 'admin.delete-renstra',
            'Toggle Aktif Renstra' => 'renstra.toggleAktif',
            'Create Legalitas' => 'admin.create-legalitas',
            'Update Legalitas' => 'admin.update-legalitas',
            'Destroy Legalitas' => 'admin.delete-legalitas',
            'Toggle Aktif Legalitas' => 'legalitas.toggleAktif',
            'Create Banner' => 'admin.create-banner',
            'Update Banner' => 'banner.update',
            'Destroy Banner' => 'banner.delete',
            'Toggle Aktif Banner' => 'banner.toggleAktif',
            'Create Role' => 'admin.add-role',
            'Create User Manager' => 'admin.add-usermanager',
            'Create Title' => 'admin.create-title',
            'Update Title' => 'title.update',
            'Destroy Title' => 'title.delete',
            'Toggle Aktif Title' => 'title.toggleAktif',
            'Create Footer' => 'admin.create-footer',
            'Update Footer' => 'footer.update',
            'Destroy Footer' => 'footer.delete',
            'Toggle Aktif Footer' => 'footer.toggleAktif',
            'Create Limit Berita' => 'create.limitberita',
            'Update Limit Berita' => 'limitberita.update',
            'Destroy Limit Berita' => 'limitberita.delete',
            'Toggle Aktif Limit Berita' => 'limit.toggleAktif',
        ];
    
        return $routes[$menuName] ?? '#';
    }
    public function getProfile(Request $request)
    {

        return view('admin.profile');
    }

    public function editProfile(Request $request)
    {
        return view('admin.update_profile');
    }

    public function updateProfile(Request $request)
    {
        $user = usermanager::findOrFail(Auth::id());

        $request->validate([
            'nama' => 'required|string|max:50',
            'login' => 'required|string|max:50',
            'pwd' => 'nullable|string|min:3',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->nama = $request->input('nama');
        $user->login = $request->input('login');

        if ($request->filled('pwd')) {
            $hashedPassword = Hash::make($request->input('pwd'));
            $user->pwd = $request->input('pwd'); // Simpan password asli (plaintext) 
            $user->pwd_baru = $hashedPassword; // Simpan password yang sudah di-hash
        }
        if ($request->hasFile('foto')) {
            if ($user->foto) {
                $oldPhotoPath = public_path('img/profile/' . $user->foto);
                if (File::exists($oldPhotoPath)) {
                    File::delete($oldPhotoPath);
                }
            }
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('img/profile'), $fileName);
            $user->foto = $fileName;
        }

        $user->save();
        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
