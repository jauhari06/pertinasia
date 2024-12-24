<?php

namespace App\Http\Controllers;

use App\Models\usermanager;
use App\Models\ms_userrole;
use App\Models\ms_menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('login', 'pwd');
        $user = usermanager::where('login', $credentials['login'])->first();

        if (!$user) {
            return redirect()->back()->withErrors('Login gagal, silahkan cek kembali username dan password anda');
        }

        if ($user->aktif != 1) {
            return redirect()->back()->withErrors('Login gagal, Akun Anda belum aktif');
        }

        if (!$user || !Hash::check($credentials['pwd'], $user->pwd_baru)) {
            return redirect()->back()->withErrors('Login gagal, silahkan cek kembali username dan password anda');
        }

        Auth::login($user);

        $user->last_login = now();
        $user->online = 1;
        $user->save();


        // Set session variables
        $request->session()->put('login-id', $user->id);
        $request->session()->put('login-nameuser', $user->login);
        $request->session()->put('login-nama', $user->nama);
        $request->session()->put('login-type', $user->tipe);
        if ($user->id_prodi) {
            $request->session()->put('id_prodi', $user->id_prodi);
        }

        // Generate menu based on user type
        if ($user->tipe == 99) {
            // Ambil semua menu untuk tipe 99
            $menu = $this->getAllMenus();
        } else {
            // Generate menu untuk tipe selain 99
            $menu = $this->generateUserMenu($user->tipe);
        }
        $request->session()->put('user-menu', $menu);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        // Log out the user

        $user = Auth::user();
        $user->online = 0;
        $user->save();

        Auth::logout();

        // Hapus semua session terkait user
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect()->route('login')->with('message', 'Anda telah logout.');
    }

    private function generateUserMenu($tipeUser)
    {
        // Ambil semua menu berdasarkan `urut` (ascending) dan status `aktif`
        $allMenus = ms_menu::where('aktif', 1)->orderBy('urut')->get();

        // Ambil menu yang sesuai dengan `tipeUser` di `ms_userrole`
        $userRoles = ms_userrole::where('id_tipeuser', $tipeUser)->pluck('id_menu')->toArray();

        $menu = [];

        // Ambil parent menus dengan parent = 0
        $parentMenus = $allMenus->where('parent', 0);

        foreach ($parentMenus as $parent) {
            // Jika menu ini ada di dalam user role atau memiliki child yang diizinkan
            if (in_array($parent->id, $userRoles) || $allMenus->where('parent', $parent->id)->pluck('id')->intersect($userRoles)->isNotEmpty()) {
                $children = $allMenus->where('parent', $parent->id)->filter(function ($child) use ($userRoles) {
                    return in_array($child->id, $userRoles);
                });

                $menuItem = [
                    'id' => $parent->id,
                    'route' => $this->getRouteForMenu($parent->nama_menu),
                    'icon' => $parent->icon_class,
                    'name' => $parent->nama_menu,
                    'children' => $this->getChildMenus($children),
                ];

                $menu[] = $menuItem;
            }
        }

        return $menu;
    }

    private function getChildMenus($childMenus)
    {
        $children = [];

        foreach ($childMenus as $child) {
            $children[] = [
                'id' => $child->id,
                'route' => $this->getRouteForMenu($child->nama_menu),
                'icon' => $child->icon_class,
                'name' => $child->nama_menu,
            ];
        }

        return $children;
    }

    private function getAllMenus()
    {
        // Ambil semua menu berdasarkan `urut` (ascending) dan status `aktif`
        $allMenus = ms_menu::where('aktif', 1)->orderBy('urut')->get();

        $menu = [];

        // Ambil parent menus dengan parent = 0
        $parentMenus = $allMenus->where('parent', 0);

        foreach ($parentMenus as $parent) {
            $children = $allMenus->where('parent', $parent->id);

            $menuItem = [
                'id' => $parent->id,
                'route' => $this->getRouteForMenu($parent->nama_menu),
                'icon' => $parent->icon_class,
                'name' => $parent->nama_menu,
                'children' => $this->getChildMenus($children),
            ];

            $menu[] = $menuItem;
        }

        return $menu;
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
}
