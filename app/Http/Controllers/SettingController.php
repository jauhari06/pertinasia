<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\banner;
use App\Models\ms_tipeuser;
use App\Models\ms_userrole;
use App\Models\usermanager;
use App\Models\ms_menu;
use App\Models\ms_titlefooter;
use App\Models\page_permalink_setting;
use App\Models\page_limitberita_setting;
use App\Models\ms_meta;

class SettingController extends Controller
{
    public function getBanner()
    {
        $banner = banner::orderBy('urut', 'asc')->paginate(4);
        return view('admin.banner', compact('banner'));
    }

    public function createBanner(Request $request)
    {
        if ($request->isMethod('post')) {
            // Validasi input
            $request->validate([
                'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
                'urut' => 'required|string|max:255',
            ]);

            // Proses upload file
            if ($request->hasFile('banner')) {
                // Ambil file gambar
                $file = $request->file('banner');

                // Buat nama file unik dengan format waktu
                $fileName = time() . '.' . $file->getClientOriginalExtension();

                // Simpan file gambar ke folder public/img/banner
                $file->move(public_path('img/banner'), $fileName);

                // Simpan data ke database
                $banner = new banner();
                $banner->banner = $fileName;
                $banner->urut = $request->input('urut');
                $banner->url = '';
                $banner->aktif = $request->input('aktif', 1);
                $banner->save();

                return redirect()->back()->with('success', 'Banner berhasil ditambahkan');
            }

            return redirect()->back()->with('error', 'Gagal mengupload banner');
        }

        return view('admin.create_banner');
    }

    public function updateBanner(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            $banner = Banner::findOrFail($id);
            return view('admin.update_banner', compact('banner'));
        }

        if ($request->isMethod('put')) {
            $banner = Banner::findOrFail($id);

            $request->validate([
                'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'urut' => 'nullable|string|max:255',
            ]);

            if ($request->hasFile('banner')) {
                $oldFile = public_path('img/banner/' . $banner->banner);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
                $file = $request->file('banner');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('img/banner'), $fileName);
                $banner->banner = $fileName;
            }
            if ($request->input('urut')) {
                $banner->urut = $request->input('urut');
            }
            $banner->save();

            return redirect()->route('admin.banner')->with('success', 'Banner berhasil diperbarui');
        }
    }

    public function destroyBanner($id)
    {
        $banner = Banner::findOrFail($id);
        $oldFile = public_path('img/banner/' . $banner->banner);
        if (file_exists($oldFile)) {
            unlink($oldFile);
        }
        $banner->delete();
        return redirect()->back()->with('success', 'Banner berhasil dihapus');
    }

    public function toggleAktifBanner($id)
    {
        $banner = banner::findOrFail($id);
        $banner->aktif = !$banner->aktif;
        $banner->save();
        return redirect()->back()->with('success', 'Status Banner berhasil diubah.');
    }

    public function getRole($id = null)
    {
        $role = ms_tipeuser::paginate(10);

        return view('admin.user_role', compact('role'));
    }

    public function createRole(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'tipe_user' => 'required|string|max:255',
                'id_menu' => 'required|array',
                'id_menu.*' => 'exists:ms_menu,id',
                'tambah' => 'array',
                'edit' => 'array',
                'hapus' => 'array',
                'status' => 'array',
            ]);

            // Buat atau ambil tipe user
            $tipeUser = ms_tipeuser::firstOrCreate(['tipe_user' => $request->input('tipe_user')]);

            // Hapus user role yang ada untuk tipe user ini
            ms_userrole::where('id_tipeuser', $tipeUser->id)->delete();

            // Simpan user role baru
            foreach ($request->input('id_menu') as $menuId) {
                $userrole = new ms_userrole();
                $userrole->id_tipeuser = $tipeUser->id;
                $userrole->id_menu = $menuId;
                $userrole->tambah = isset($request->input('tambah')[$menuId]) ? 1 : 0;
                $userrole->edit = isset($request->input('edit')[$menuId]) ? 1 : 0;
                $userrole->hapus = isset($request->input('hapus')[$menuId]) ? 1 : 0;
                $userrole->status = isset($request->input('status')[$menuId]) ? 1 : 0;
                $userrole->save();
            }

            return redirect()->route('admin.role')->with('success', 'User Role berhasil ditambahkan');
        }

        $menus = ms_menu::where('parent', 0)->with('childMenus')->get();
        $menuHierarchy = $this->renderMenuHierarchy($menus, $request->input('id_tipeuser'));
        return view('admin.create_role', compact('menuHierarchy'));
    }

    public function updateRole(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            $role = ms_tipeuser::findOrFail($id);
            $menus = ms_menu::where('parent', 0)->with('childMenus')->get();

            $oldValues = [];
            if ($id) {
                $oldValues = [
                    'id_menu' => ms_userrole::where('id_tipeuser', $id)->pluck('id_menu')->toArray(),
                    'tambah' => ms_userrole::where('id_tipeuser', $id)->where('tambah', 1)->pluck('id_menu')->toArray(),
                    'edit' => ms_userrole::where('id_tipeuser', $id)->where('edit', 1)->pluck('id_menu')->toArray(),
                    'hapus' => ms_userrole::where('id_tipeuser', $id)->where('hapus', 1)->pluck('id_menu')->toArray(),
                    'status' => ms_userrole::where('id_tipeuser', $id)->where('status', 1)->pluck('id_menu')->toArray(),
                ];
            }

            $menuHierarchy = $this->renderMenuHierarchy($menus, $id, $oldValues);
            return view('admin.update_role', compact('role', 'menuHierarchy', 'id'));
        }

        if ($request->isMethod('put')) {

            $request->validate([
                'tipe_user' => 'required|string|max:255',
                'id_menu' => 'required|array',
                'id_menu.*' => 'exists:ms_menu,id',
                'tambah' => 'array',
                'edit' => 'array',
                'hapus' => 'array',
                'status' => 'array',
            ]);

            // Ambil tipe user
            $tipeUser = ms_tipeuser::findOrFail($id);
            $tipeUser->tipe_user = $request->input('tipe_user');
            $tipeUser->save();

            ms_userrole::where('id_tipeuser', $id)->delete();
            // Simpan atau perbarui user role
            foreach ($request->input('id_menu') as $menuId) {
                $userrole = ms_userrole::firstOrNew([
                    'id_tipeuser' => $tipeUser->id,
                    'id_menu' => $menuId,
                ]);

                $userrole->tambah = isset($request->input('tambah')[$menuId]) ? 1 : 0;
                $userrole->edit = isset($request->input('edit')[$menuId]) ? 1 : 0;
                $userrole->hapus = isset($request->input('hapus')[$menuId]) ? 1 : 0;
                $userrole->status = isset($request->input('status')[$menuId]) ? 1 : 0;
                $userrole->save();
            }

            return redirect()->route('admin.role', ['id' => $id])->with('success', 'User Role berhasil diperbarui');
        }
    }


    public function renderMenuHierarchy($menus, $id_tipeuser, $oldValues = [], $level = 0)
    {
        $list = '';

        foreach ($menus as $menu) {
            // Get user role data for the checkboxes
            $userRole = ms_userrole::where('id_tipeuser', $id_tipeuser)->where('id_menu', $menu->id)->first();
            $checked = isset($oldValues['id_menu']) && in_array($menu->id, $oldValues['id_menu']) ? 'checked' : ($userRole ? 'checked' : '');
            $tambahChecked = isset($oldValues['tambah']) && in_array($menu->id, $oldValues['tambah']) ? 'checked' : ($userRole && $userRole->tambah ? 'checked' : '');
            $editChecked = isset($oldValues['edit']) && in_array($menu->id, $oldValues['edit']) ? 'checked' : ($userRole && $userRole->edit ? 'checked' : '');
            $hapusChecked = isset($oldValues['hapus']) && in_array($menu->id, $oldValues['hapus']) ? 'checked' : ($userRole && $userRole->hapus ? 'checked' : '');
            $statusChecked = isset($oldValues['status']) && in_array($menu->id, $oldValues['status']) ? 'checked' : ($userRole && $userRole->status ? 'checked' : '');

            // Create class and padding for child menus
            $class = $level == 0 ? 'parent' : 'child';
            $padding = $level > 0 ? 'style="padding-left: ' . ($level * 40) . 'px;"' : ''; // Indentation for child menus

            // Render parent menu with only the first checkbox for top-level menus
            $list .= '<tr class="' . $class . '">';
            $list .= '<td ' . $padding . '><input type="checkbox" name="id_menu[]" value="' . $menu->id . '" ' . $checked . ' data-checked="' . ($checked ? '1' : '0') . '"> ' . $menu->nama_menu . '</td>';

            if ($level > 0) {
                // Render child menus with all checkboxes
                $list .= '<td><input type="checkbox" name="tambah[' . $menu->id . ']" value="1" ' . $tambahChecked . ' data-checked="' . ($tambahChecked ? '1' : '0') . '"></td>';
                $list .= '<td><input type="checkbox" name="edit[' . $menu->id . ']" value="1" ' . $editChecked . ' data-checked="' . ($editChecked ? '1' : '0') . '"></td>';
                $list .= '<td><input type="checkbox" name="hapus[' . $menu->id . ']" value="1" ' . $hapusChecked . ' data-checked="' . ($hapusChecked ? '1' : '0') . '"></td>';
                $list .= '<td><input type="checkbox" name="status[' . $menu->id . ']" value="1" ' . $statusChecked . ' data-checked="' . ($statusChecked ? '1' : '0') . '"></td>';
            } else {
                // Empty cells for top-level menus (parent_id = 0)
                $list .= '<td></td><td></td><td></td><td></td>';
            }

            $list .= '</tr>';

            // Recursive call for child menus
            if ($menu->childMenus->count()) {
                $list .= $this->renderMenuHierarchy($menu->childMenus, $id_tipeuser, $oldValues, $level + 1);
            }
        }

        return $list;
    }

    public function destroyRole($id)
    {
        $role = ms_tipeuser::findOrFail($id);
        $role->delete();
        return redirect()->back()->with('success', 'Role berhasil dihapus');
    }

    public function getUserManager()
    {
        $usermanager = usermanager::with('tipeUser')->paginate(10);
        $role = ms_tipeuser::all();
        return view('admin.user_manager', compact('usermanager', 'role'));
    }

    public function createUserManager(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nama' => 'required|string|max:255',
                'login' => 'required|string|max:255',
                'pwd' => 'required|string|max:255',
                'tipe' => 'required|integer',
            ]);

            $usermanager = new usermanager();
            $usermanager->nama = $request->input('nama');
            $usermanager->login = $request->input('login');
            $usermanager->pwd = $request->input('pwd');
            $usermanager->pwd_baru = bcrypt($request->input('pwd'));
            $usermanager->tipe = $request->input('tipe');
            $usermanager->aktif = '1';
            $usermanager->id_prodi = '0';
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('img/profile'), $filename);
                $usermanager->foto = $filename;
            }

            $usermanager->save();

            return redirect()->route('admin.usermanager')->with('success', 'User Manager berhasil ditambahkan');
        }

        $role = ms_tipeuser::all();
        return view('admin.create_usermanager', compact('role'));
    }

    public function editUserManager($id)
    {
        $usermanager = usermanager::with('tipeUser')->findOrFail($id);
        $role = ms_tipeuser::all();
        return view('admin.update_usermanager', compact('usermanager', 'role'));
    }

    public function updateUserManager(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:usermanager,login,' . $id,
            'tipe' => 'required|integer',
        ]);

        $usermanager = usermanager::findOrFail($id);

        // Periksa apakah input ada sebelum memperbarui nilai
        $usermanager->nama = $request->input('nama', $usermanager->nama);
        $usermanager->login = $request->input('login', $usermanager->login);
        $usermanager->tipe = $request->input('tipe', $usermanager->tipe);
        $usermanager->aktif = $request->input('aktif', $usermanager->aktif);
        $usermanager->id_prodi = $request->input('id_prodi', $usermanager->id_prodi);

        // Periksa apakah password diisi
        if ($request->filled('pwd')) {
            $usermanager->pwd = $request->input('pwd'); // Simpan password sebagai string biasa
            $usermanager->pwd_baru = bcrypt($request->input('pwd')); // Hash password dan simpan ke kolom pwd_baru
        }

        // Periksa apakah file foto diunggah
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/profile'), $filename);
            $usermanager->foto = $filename;
        }

        $usermanager->save();

        return redirect()->route('admin.usermanager')->with('success', 'User Manager berhasil diupdate');
    }

    public function ToggleAktifUserManager($id)
    {
        $usermanager = usermanager::findOrFail($id);
        $usermanager->aktif = !$usermanager->aktif;
        $usermanager->save();
        return redirect()->back()->with('success', 'Status User Manager berhasil diubah');
    }

    public function destroyUserManager($id)
    {
        $usermanager = usermanager::findOrFail($id);
        $usermanager->delete();
        return redirect()->back()->with('success', 'User Manager berhasil dihapus');
    }

    public function getMenu()
    {
        $menu = ms_menu::with('parentMenu')->paginate(10);
        return view('admin.menu', compact('menu'));
    }

    public function createMenu(Request $request)
    {
        if ($request->isMethod('post')) {
            // Validasi data
            $request->validate([
                'nama_menu' => 'required|string|max:255',
                'parameter' => 'nullable|string|max:255',
                'parent' => 'nullable|exists:ms_menu,id',
                'tipe' => 'required|string|in:custom,link,statis',
                'tampil' => 'required|string|in:Y,N',
                'urut' => 'nullable|integer',
                'icon_class' => 'nullable|string|max:255',
                'subpage' => 'required|string|in:Y,N',
                'shortcut' => 'required|string|in:Y,N',
            ]);

            $lvl = $request->parent ? 1 : 0;

            // Buat menu baru
            $menu = new ms_menu();
            $menu->nama_menu = $request->nama_menu;
            $menu->parameter = $request->parameter;
            $menu->parent = $request->parent;
            $menu->tipe = $request->tipe;
            $menu->tampil = $request->tampil;
            $menu->urut = $request->urut;
            $menu->icon_class = $request->icon_class;
            $menu->subpage = $request->subpage;
            $menu->shortcut = $request->shortcut;
            $menu->lvl = $lvl;
            $menu->save();

            // Redirect ke halaman yang sesuai dengan pesan sukses
            return redirect()->route('admin.menu')->with('success', 'Menu berhasil dibuat.');
        }

        // Jika request adalah GET, tampilkan form
        $menu = ms_menu::all();
        return view('admin.create_menu', compact('menu'));
    }

    public function editMenu($id)
    {
        $menu = ms_menu::with('parentMenu')->findOrFail($id);
        $menus = ms_menu::all();
        return view('admin.update_menu', compact('menu', 'menus'));
    }
    public function updateMenu(Request $request, $id)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'parameter' => 'nullable|string|max:255',
            'parent' => 'nullable|exists:ms_menu,id',
            'tipe' => 'required|string|in:custom,link,statis',
            'tampil' => 'required|string|in:Y,N',
            'urut' => 'nullable|integer',
            'icon_class' => 'nullable|string|max:255',
            'subpage' => 'required|string|in:Y,N',
            'shortcut' => 'required|string|in:Y,N',
        ]);

        $menu = ms_menu::findOrFail($id);
        $menu->nama_menu = $request->nama_menu;
        $menu->parameter = $request->parameter;
        $menu->parent = $request->parent;
        $menu->tipe = $request->tipe;
        $menu->tampil = $request->tampil;
        $menu->urut = $request->urut;
        $menu->icon_class = $request->icon_class;
        $menu->subpage = $request->subpage;
        $menu->shortcut = $request->shortcut;
        $menu->save();

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil diupdate');
    }

    public function destroyMenu($id)
    {
        $menu = ms_menu::findOrFail($id);
        $menu->delete();
        return redirect()->back()->with('success', 'Menu berhasil dihapus');
    }

    public function toggleAktifMenu($id)
    {
        $menu = ms_menu::findOrFail($id);
        $menu->aktif = !$menu->aktif;
        $menu->save();
        return redirect()->back()->with('success', 'Status Menu berhasil diubah');
    }

    public function getTitle()
    {
        $settingtitle = ms_titlefooter::where('tipe', 't')->paginate(10);
        return view('admin.title', compact('settingtitle'));
    }

    public function createTitle(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'teks' => 'required|string|max:255',
            ]);

            $settingtitle = new ms_titlefooter();
            $settingtitle->teks = $request->input('teks');
            $settingtitle->teks_en = '';
            $settingtitle->tipe = 't';
            $settingtitle->aktif = $request->input('aktif', 1);
            $settingtitle->save();

            return redirect()->route('admin.title')->with('success', 'Kategori berhasil ditambahkan');
        }

        return view('admin.create_title');
    }

    public function editTitle($id)
    {
        $settingtitle = ms_titlefooter::findOrFail($id);
        return view('admin.update_title', compact('settingtitle'));
    }

    public function updateTitle(Request $request, $id)
    {
        $request->validate([
            'teks' => 'required|string|max:255',
        ]);

        $settingtitle = ms_titlefooter::findOrFail($id);
        $settingtitle->teks = $request->input('teks');
        $settingtitle->save();

        return redirect()->route('admin.title')->with('success', 'Title berhasil diupdate');
    }


    public function destroyTitle($id)
    {
        $settingtitle = ms_titlefooter::findOrFail($id);
        $settingtitle->delete();

        return redirect()->back()->with('success', 'Title berhasil dihapus');
    }

    public function toggleAktifTitle($id)
    {
        $settingtitle = ms_titlefooter::findOrFail($id);
        $settingtitle->aktif = !$settingtitle->aktif;
        $settingtitle->save();
        return redirect()->back()->with('success', 'Status Title berhasil diubah.');
    }

    public function getFooter()
    {
        $settingfooter = ms_titlefooter::where('tipe', 'f')->paginate(10);
        $settingfooter->transform(function ($item) {
            $item->teks = strip_tags($item->teks);
            return $item;
        });
        return view('admin.footer', compact('settingfooter'));
    }

    public function createFooter(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'teks' => 'required|string|max:255',
            ]);

            $settingfooter = new ms_titlefooter();
            $settingfooter->teks = $request->input('teks');
            $settingfooter->teks_en = '';
            $settingfooter->tipe = 'f';
            $settingfooter->aktif = $request->input('aktif', 1);
            $settingfooter->save();

            return redirect()->route('admin.footer')->with('success', 'Footer berhasil ditambahkan');
        }

        return view('admin.create_footer');
    }

    public function editFooter($id)
    {
        $settingfooter = ms_titlefooter::findOrFail($id);
        return view('admin.update_footer', compact('settingfooter'));
    }

    public function updateFooter(Request $request, $id)
    {
        $request->validate([
            'teks' => 'required|string|max:255',
        ]);

        $settingfooter = ms_titlefooter::findOrFail($id);
        $settingfooter->teks = $request->input('teks');
        $settingfooter->save();

        return redirect()->route('admin.footer')->with('success', 'Footer berhasil diupdate');
    }

    public function destroyFooter($id)
    {
        $settingfooter = ms_titlefooter::findOrFail($id);
        $settingfooter->delete();

        return redirect()->back()->with('success', 'Footer berhasil dihapus');
    }

    public function toggleAktifFooter($id)
    {
        $settingfooter = ms_titlefooter::findOrFail($id);
        $settingfooter->aktif = !$settingfooter->aktif;
        $settingfooter->save();
        return redirect()->back()->with('success', 'Status Footer berhasil diubah.');
    }

    public function getPermalink()
    {
        $permalink = page_permalink_setting::all();
        return view('admin.permalink', compact('permalink'));
    }
    public function getLimitBerita()
    {
        $limitberita = page_limitberita_setting::paginate(10);
        return view('admin.limit_berita', compact('limitberita'));
    }

    public function createLimitBerita(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'limit_berita' => 'required|integer|min:0|max:32767',
            ]);

            $limit = new page_limitberita_setting();
            $limit->limit_berita = $request->input('limit_berita');
            $limit->aktif = $request->input('aktif', 1);
            $limit->save();

            return redirect()->route('admin.limitberita')->with('success', 'Footer berhasil ditambahkan');
        }

        return view('admin.create_limitberita');
    }

    public function editLimitBerita($id)
    {
        $limitberita = page_limitberita_setting::findOrFail($id);
        return view('admin.update_limitberita', compact('limitberita'));
    }

    public function updateLimitBerita(Request $request, $id)
    {
        $request->validate([
            'limit_berita' => 'required|integer|min:0|max:32767',
        ]);

        $limit = page_limitberita_setting::findOrFail($id);
        $limit->limit_berita = $request->input('limit_berita');
        $limit->save();

        return redirect()->route('admin.limitberita')->with('success', 'Limit Berita berhasil diupdate');
    }

    public function destroyLimitBerita($id)
    {
        $limit = page_limitberita_setting::findOrFail($id);
        $limit->delete();

        return redirect()->back()->with('success', 'Limit Berita berhasil dihapus');
    }

    public function toggleAktifLimitBerita($id)
    {
        $limit = page_limitberita_setting::findOrFail($id);
        $limit->aktif = !$limit->aktif;
        $limit->save();
        return redirect()->back()->with('success', 'Status Limit Berita berhasil diubah.');
    }

    public function getKeyword()
    {
        $keyword = ms_meta::where('tipe', 'k')->paginate(10);
        return view('admin.keyword', compact('keyword'));
    }

    public function createKeyword(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'teks' => 'required|string|max:255',
            ]);

            $keyword = new ms_meta();
            $keyword->teks = $request->input('teks');
            $keyword->tipe = 'k';
            $keyword->aktif = $request->input('aktif', 1);
            $keyword->save();

            return redirect()->route('admin.keyword')->with('success', 'Keyword berhasil ditambahkan');
        }

        return view('admin.create_keyword');
    }

    public function editKeyword($id)
    {
        $keyword = ms_meta::findOrFail($id);
        return view('admin.update_keyword', compact('keyword'));
    }

    public function updateKeyword(Request $request, $id)
    {
        $request->validate([
            'teks' => 'required|string|max:255',
        ]);

        $keyword = ms_meta::findOrFail($id);
        $keyword->teks = $request->input('teks');
        $keyword->save();

        return redirect()->route('admin.keyword')->with('success', 'Keyword berhasil diupdate');
    }

    public function destroyKeyword($id)
    {
        $keyword = ms_meta::findOrFail($id);
        $keyword->delete();

        return redirect()->back()->with('success', 'Keyword berhasil dihapus');
    }

    public function toggleAktifKeyword($id)
    {
        $keyword = ms_meta::findOrFail($id);
        $keyword->aktif = !$keyword->aktif;
        $keyword->save();
        return redirect()->back()->with('success', 'Status Keyword berhasil diubah.');
    }

    public function getDescription()
    {
        $description = ms_meta::where('tipe', 'd')->paginate(10);
        return view('admin.description', compact('description'));
    }

    public function createDescription(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'teks' => 'required|string|max:255',
            ]);

            $description = new ms_meta();
            $description->teks = $request->input('teks');
            $description->tipe = 'd';
            $description->aktif = $request->input('aktif', 1);
            $description->save();

            return redirect()->route('admin.description')->with('success', 'Description berhasil ditambahkan');
        }

        return view('admin.create_description');
    }

    public function editDescription($id)
    {
        $description = ms_meta::findOrFail($id);
        return view('admin.update_description', compact('description'));
    }

    public function updateDescription(Request $request, $id)
    {
        $request->validate([
            'teks' => 'required|string|max:255',
        ]);

        $description = ms_meta::findOrFail($id);
        $description->teks = $request->input('teks');
        $description->save();

        return redirect()->route('admin.description')->with('success', 'Description berhasil diupdate');
    }

    public function destroyDescription($id)
    {
        $description = ms_meta::findOrFail($id);
        $description->delete();

        return redirect()->back()->with('success', 'Description berhasil dihapus');
    }

    public function toggleAktifDescription($id)
    {
        $description = ms_meta::findOrFail($id);
        $description->aktif = !$description->aktif;
        $description->save();
        return redirect()->back()->with('success', 'Status Description berhasil diubah.');
    }

    public function searchBanner(Request $request)
    {
        $key = $request->input('key');

        $banner = banner::where('deskripsi', 'like', "%{$key}%")
            ->orWhere('banner', 'like', "%{$key}%")
            ->orWhere('url', 'like', "%{$key}%")
            ->paginate(10);


        return view('admin.banner', compact('banner', 'key'));
    }

    public function searchRole(Request $request)
    {
        $key = $request->input('key');

        $role = ms_tipeuser::where('tipe_user', 'like', "%{$key}%")
            ->paginate(10);


        return view('admin.user_role', compact('role', 'key'));
    }

    public function searchUser(Request $request)
    {
        $key = $request->input('key');

        $usermanager = usermanager::where('nama', 'like', "%{$key}%")
            ->orWhere('login', 'like', "%{$key}%")
            ->paginate(10);


        return view('admin.user_manager', compact('usermanager', 'key'));
    }

    public function searchMenu(Request $request)
    {
        $key = $request->input('key');

        $menu = ms_menu::where('nama_menu', 'like', "%{$key}%")
            ->orWhere('parameter', 'like', "%{$key}%")
            ->orWhere('nama_menu_en', 'like', "%{$key}%")
            ->orWhere('parent', 'like', "%{$key}%")
            ->orWhere('tipe', 'like', "%{$key}%")
            ->orWhere('icon_class', 'like', "%{$key}%")
            ->orWhere('shortcut', 'like', "%{$key}%")
            ->paginate(10);


        return view('admin.menu', compact('menu', 'key'));
    }

    public function searchTitle(Request $request)
    {
        $key = $request->input('key');

        $settingtitle = ms_titlefooter::where('tipe', 't')
            ->where(function ($query) use ($key) {
                $query->where('teks', 'like', "%{$key}%")
                    ->orWhere('teks_en', 'like', "%{$key}%");
            })
            ->paginate(10);


        return view('admin.title', compact('settingtitle', 'key'));
    }

    public function searchFooter(Request $request)
    {
        $key = $request->input('key');

        $settingfooter = ms_titlefooter::where('tipe', 'f')
            ->where(function ($query) use ($key) {
                $query->where('teks', 'like', "%{$key}%")
                    ->orWhere('teks_en', 'like', "%{$key}%");
            })
            ->paginate(10);


        return view('admin.footer', compact('settingfooter', 'key'));
    }

    public function searchDescription(Request $request)
    {
        $key = $request->input('key');

        $description = ms_meta::where('tipe', 'd')
            ->where(function ($query) use ($key) {
                $query->where('teks', 'like', "%{$key}%");
            })
            ->paginate(10);


        return view('admin.description', compact('description', 'key'));
    }

    public function searchKeyword(Request $request)
    {
        $key = $request->input('key');

        $keyword = ms_meta::where('tipe', 'k')
            ->where(function ($query) use ($key) {
                $query->where('teks', 'like', "%{$key}%");
            })
            ->paginate(10);

        return view('admin.keyword', compact('keyword', 'key'));
    }
}
