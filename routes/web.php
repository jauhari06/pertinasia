<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\CetakFormController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->middleware('VisitorCounter')->name('home');
Route::get('/pendaftaran', [PendaftaranController::class, 'formPendaftaran'])->name('pendaftaran');
Route::post('/pendaftaran', [PendaftaranController::class, 'submitForm'])->name('submit-form');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{id}', [BeritaController::class, 'berita_detail'])->name('detail-berita');
Route::get('/media', [MediaController::class, 'index'])->name('media');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/administrator', [AuthController::class, 'index'])->name('login');
Route::post('/administrator', [AuthController::class, 'login'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['EnsureUserIsLoggedIn'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/get-pengunjung-per-bulan', [DashboardController::class, 'getPengunjungPerBulan'])->name('getPengunjungPerBulan');
    Route::get('/admin/dashboard/detail-kunjungan', [DashboardController::class, 'getDetailKunjungan'])->name('admin.dashboard.detail');

    Route::get('/admin/profile', [DashboardController::class, 'getProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [DashboardController::class, 'editProfile'])->name('edit.profile');
    Route::put('/admin/profile/edit', [DashboardController::class, 'updateProfile'])->name('admin.profile.update');

    Route::get('/admin/link/kategori', [LinkController::class, 'kategori'])->name('admin.kategori-link');
    Route::match(['get', 'post'], '/admin/link/kategori/create', [LinkController::class, 'createKategori'])->name('admin.create-kategori-link');
    Route::get('/link/kategori/{id}/edit', [LinkController::class, 'editKategori'])->name('link-kategori.edit');
    Route::put('/link/kategori/update/{id}', [LinkController::class, 'updateKategori'])->name('link-kategori.update');
    Route::delete('/link/kategori/{id}', [LinkController::class, 'destroyKategori'])->name('link-kategori.delete');
    Route::post('/link/kategori/toggle-aktif/{id}', [LinkController::class, 'toggleAktifKategori'])->name('link-kategori.toggleAktif');

    Route::get('/admin/link', [LinkController::class, 'index'])->name('admin.link');
    Route::match(['get', 'post'], '/admin/link/create', [LinkController::class, 'createLink'])->name('admin.create-link');
    Route::get('/link/{id}/edit', [LinkController::class, 'editLink'])->name('link.edit');
    Route::put('/link/update/{id}', [LinkController::class, 'updateLink'])->name('link.update');
    Route::delete('/link/{id}', [LinkController::class, 'destroyLink'])->name('link.delete');
    Route::post('/link/toggle-aktif/{id}', [LinkController::class, 'toggleAktifLink'])->name('link.toggleAktif');

    Route::get('/kategori/search', [LinkController::class, 'searchKategori'])->name('kategori-link.search');
    Route::get('/link/search', [LinkController::class, 'searchLink'])->name('link.search');


    Route::get('/admin/pendaftaran', [PendaftaranController::class, 'index'])->name('admin.pendaftaran');
    Route::get('/admin/pendaftaran/cetak/{id}', [PendaftaranController::class, 'cetakPendaftaran'])->name('cetak');
    Route::put('/pendaftaran/update/{id}', [PendaftaranController::class, 'updatePendaftaran'])->name('updatePendaftaran');
    Route::delete('/pendaftaran/{id}', [PendaftaranController::class, 'destroyPendaftaran'])->name('deletePendaftaran');

    Route::get('/pendaftaran/search', [PendaftaranController::class, 'search'])->name('pendaftaran.search');


    Route::get('/admin/banner', [SettingController::class, 'getBanner'])->name('admin.banner');
    Route::match(['get', 'post'], '/admin/banner/create', [SettingController::class, 'createBanner'])->name('admin.create-banner');
    Route::match(['get', 'put'], 'banner/{id}/update', [SettingController::class, 'updateBanner'])->name('banner.update');
    Route::delete('/banner/{id}', [SettingController::class, 'destroyBanner'])->name('banner.delete');
    Route::post('/banner/toggle-aktif/{id}', [SettingController::class, 'toggleAktifBanner'])->name('banner.toggleAktif');

    Route::get('/admin/user/role', [SettingController::class, 'getRole'])->name('admin.role');
    Route::match(['get', 'post'], '/admin/user/role/create', [SettingController::class, 'createRole'])->name('admin.add-role');
    Route::match(['get', 'put'], 'role/{id}/update', [SettingController::class, 'updateRole'])->name('role.update');
    Route::delete('/role/{id}', [SettingController::class, 'destroyRole'])->name('role.delete');

    Route::get('/admin/usermanager', [SettingController::class, 'getUserManager'])->name('admin.usermanager');
    Route::match(['get', 'post'], '/admin/usermanager/create', [SettingController::class, 'createUserManager'])->name('admin.add-usermanager');
    Route::get('/usermanager/{id}/edit', [SettingController::class, 'editUserManager'])->name('usermanager.edit');
    Route::put('/usermanager/{id}', [SettingController::class, 'updateUserManager'])->name('usermanager.update');
    Route::delete('/usermanager/{id}', [SettingController::class, 'destroyUserManager'])->name('usermanager.delete');
    Route::post('/usermanager/toggle-aktif/{id}', [SettingController::class, 'toggleAktifUserManager'])->name('usermanager.toggleAktif');

    Route::get('/admin/menu', [SettingController::class, 'getMenu'])->name('admin.menu');
    Route::match(['get', 'post'], '/admin/menu/create', [SettingController::class, 'createMenu'])->name('admin.create-menu');
    Route::get('/menu/{id}/update', [SettingController::class, 'editMenu'])->name('menu.edit');
    Route::put('/menu/{id}', [SettingController::class, 'updateMenu'])->name('menu.update');
    Route::delete('/menu/{id}', [SettingController::class, 'destroyMenu'])->name('menu.delete');
    Route::post('/menu/toggle-aktif/{id}', [SettingController::class, 'toggleAktifMenu'])->name('menu.toggleAktif');

    Route::get('/admin/title', [SettingController::class, 'getTitle'])->name('admin.title');
    Route::match(['get', 'post'], '/admin/title/create', [SettingController::class, 'createTitle'])->name('admin.create-title');
    Route::get('/title/{id}/update', [SettingController::class, 'editTitle'])->name('edit.title');
    Route::put('/title/{id}', [SettingController::class, 'updateTitle'])->name('title.update');
    Route::delete('/title/{id}', [SettingController::class, 'destroyTitle'])->name('title.delete');
    Route::post('/title/toggle-aktif/{id}', [SettingController::class, 'toggleAktifTitle'])->name('title.toggleAktif');

    Route::get('/admin/footer', [SettingController::class, 'getFooter'])->name('admin.footer');
    Route::match(['get', 'post'], '/admin/footer/create', [SettingController::class, 'createFooter'])->name('admin.create-footer');
    Route::get('/footer/{id}/update', [SettingController::class, 'editFooter'])->name('footer.edit');
    Route::put('/footer/{id}', [SettingController::class, 'updateFooter'])->name('footer.update');
    Route::delete('/footer/{id}', [SettingController::class, 'destroyFooter'])->name('footer.delete');
    Route::post('/footer/toggle-aktif/{id}', [SettingController::class, 'toggleAktifFooter'])->name('footer.toggleAktif');

    Route::get('/admin/berita', [BeritaController::class, 'allberita'])->name('admin.berita');
    Route::match(['get', 'post'], '/admin/berita/create', [BeritaController::class, 'createBerita'])->name('admin.berita.create');
    Route::post('/berita/upload-image', [BeritaController::class, 'uploadImage'])->name('uploadImage');
    Route::post('/berita/delete-image', [BeritaController::class, 'deleteImage'])->name('deleteImage');
    Route::get('/berita/{id}/edit', [BeritaController::class, 'editBerita'])->name('berita.edit');
    Route::put('/berita/update/{id}', [BeritaController::class, 'updateBerita'])->name('berita.update');
    Route::delete('/berita/{id}', [BeritaController::class, 'destroyBerita'])->name('berita.destroy');
    Route::post('/berita/toggle-aktif/{id}', [BeritaController::class, 'toggleAktifBerita'])->name('berita.toggleAktif');

    Route::get('/admin/berita/kategori', [BeritaController::class, 'kategori'])->name('admin.kategori-berita');
    Route::match(['get', 'post'], '/admin/berita/kategori/create', [BeritaController::class, 'createKategori'])->name('admin.create-kategori-berita');
    Route::get('/berita/kategori/{id}/edit', [BeritaController::class, 'editKategori'])->name('kategori-berita.edit');
    Route::put('/admin/berita/kategori/update/{id}', [BeritaController::class, 'updateKategori'])->name('kategori-berita.update');
    Route::delete('/admin/berita/kategori/{id}', [BeritaController::class, 'destroyKategori'])->name('kategori-berita.destroy');
    Route::post('/admin/berita/kategori/toggle-aktif/{id}', [BeritaController::class, 'toggleAktifKategori'])->name('kategori-berita.toggleAktif');

    Route::get('/search/kategori', [BeritaController::class, 'searchKategori'])->name('kategori.search');
    Route::get('/search/berita', [BeritaController::class, 'searchBerita'])->name('berita.search');

    Route::get('/admin/album', [MediaController::class, 'album'])->name('admin.album');
    Route::match(['get', 'post'], '/admin/album/create', [MediaController::class, 'createAlbum'])->name('admin.album.create');
    Route::get('/album/{id}/edit', [MediaController::class, 'editAlbum'])->name('album.edit');
    Route::put('/album/update/{id}', [MediaController::class, 'updateAlbum'])->name('album.update');
    Route::delete('/album/{id}', [MediaController::class, 'destroyAlbum'])->name('album.delete');
    Route::post('/album/toggle-aktif/{id}', [MediaController::class, 'toggleAktifAlbum'])->name('album.toggleAktif');
    // Route::get('/album/{id}', [MediaController::class, 'showFoto'])->name('album.foto');//



    Route::get('/admin/foto/all', [MediaController::class, 'foto'])->name('admin.all-foto');
    Route::match(['get', 'post'], '/admin/foto/create', [MediaController::class, 'createOrStoreFoto'])->name('admin.foto.create');
    Route::get('/foto/{id}/edit', [MediaController::class, 'editFoto'])->name('foto.edit');
    Route::put('/foto/{id}', [MediaController::class, 'updateFoto'])->name('foto.update');
    Route::delete('/foto/{id}', [MediaController::class, 'deleteFoto'])->name('foto.delete');
    Route::post('/foto/toggle-aktif/{id}', [MediaController::class, 'toggleAktifFoto'])->name('foto.toggleAktif');

    Route::get('/admin/video', [MediaController::class, 'video'])->name('admin.video');
    Route::match(['get', 'post'], '/admin/video/create', [MediaController::class, 'createVideo'])->name('admin.video.create');
    Route::get('/video/{id}/update', [MediaController::class, 'editVideo'])->name('video.edit');
    Route::put('/video/{id}', [MediaController::class, 'updateVideo'])->name('video.update');
    Route::delete('/video/{id}', [MediaController::class, 'destroyVideo'])->name('video.delete');
    Route::post('/video/toggle-aktif/{id}', [MediaController::class, 'toggleAktifVideo'])->name('video.toggleAktif');

    Route::get('/search/album', [MediaController::class, 'searchAlbum'])->name('album.search');
    Route::get('/search/foto', [MediaController::class, 'searchFoto'])->name('foto.search');


    Route::get('/admin/risalah', [AboutController::class, 'risalah'])->name('admin.risalah');
    Route::match(['get', 'post'], '/admin/risalah/create', [AboutController::class, 'createRisalah'])->name('admin.create-risalah');
    Route::get('/risalah/{id}/update', [AboutController::class, 'editRisalah'])->name('admin.edit-risalah');
    Route::put('/risalah/{id}', [AboutController::class, 'updateRisalah'])->name('admin.update-risalah');
    Route::delete('/risalah/{id}', [AboutController::class, 'destroyRisalah'])->name('admin.delete-risalah');
    Route::post('/risalah/toggle-aktif/{id}', [AboutController::class, 'toggleAktifRisalah'])->name('risalah.toggleAktif');

    Route::get('/admin/renstra', [AboutController::class, 'renstra'])->name('admin.renstra');
    Route::match(['get', 'post'], '/admin/renstra/create', [AboutController::class, 'createRenstra'])->name('admin.create-renstra');
    Route::get('/renstra/{id}/update', [AboutController::class, 'editRenstra'])->name('admin.edit-renstra');
    Route::put('/renstra/{id}', [AboutController::class, 'updateRenstra'])->name('admin.update-renstra');
    Route::delete('/renstra/{id}', [AboutController::class, 'destroyRenstra'])->name('admin.delete-renstra');
    Route::post('/renstra/toggle-aktif/{id}', [AboutController::class, 'toggleAktifRenstra'])->name('renstra.toggleAktif');

    Route::get('/admin/legalitas', [AboutController::class, 'legalitas'])->name('admin.legalitas');
    Route::match(['get', 'post'], '/admin/legalitas/create', [AboutController::class, 'createLegalitas'])->name('admin.create-legalitas');
    Route::get('/legalitas/{id}/update', [AboutController::class, 'editLegalitas'])->name('admin.edit-legalitas');
    Route::put('/legalitas/{id}', [AboutController::class, 'updateLegalitas'])->name('admin.update-legalitas');
    Route::delete('/legalitas/{id}', [AboutController::class, 'destroyLegalitas'])->name('admin.delete-legalitas');
    Route::post('/legalitas/toggle-aktif/{id}', [AboutController::class, 'toggleAktifLegalitas'])->name('legalitas.toggleAktif');

    Route::get('/search/risalah', [AboutController::class, 'searchRisalah'])->name('risalah.search');
    Route::get('/search/renstra', [AboutController::class, 'searchRenstra'])->name('renstra.search');
    Route::get('/search/legalitas', [AboutController::class, 'searchlegalitas'])->name('legalitas.search');

    Route::get('/admin/berita/limit', [SettingController::class, 'getLimitBerita'])->name('admin.limitberita');
    Route::match(['get', 'post'], '/admin/limit_berita/create', [SettingController::class, 'createLimitBerita'])->name('create.limitberita');
    Route::get('/berita/limit/{id}/update', [SettingController::class, 'editLimitBerita'])->name('edit.limitberita');
    Route::put('/berita/limit/{id}', [SettingController::class, 'updateLimitBerita'])->name('limitberita.update');
    Route::delete('/berita/limit/{id}', [SettingController::class, 'destroyLimitBerita'])->name('limitberita.delete');
    Route::post('/berita/limit/toggle-aktif/{id}', [SettingController::class, 'toggleAktifLimitBerita'])->name('limit.toggleAktif');

    Route::get('/admin/permalink', [SettingController::class, 'getPermalink'])->name('admin.permalink');

    Route::get('/admin/keyword', [SettingController::class, 'getKeyword'])->name('admin.keyword');
    Route::match(['get', 'post'], '/admin/keyword/create', [SettingController::class, 'createKeyword'])->name('admin.create-keyword');
    Route::get('/keyword/{id}/update', [SettingController::class, 'editKeyword'])->name('edit.keyword');
    Route::put('/keyword/{id}', [SettingController::class, 'updateKeyword'])->name('keyword.update');
    Route::delete('/keyword/{id}', [SettingController::class, 'destroyKeyword'])->name('keyword.delete');
    Route::post('/keyword/toggle-aktif/{id}', [SettingController::class, 'toggleAktifKeyword'])->name('keyword.toggleAktif');

    Route::get('/admin/description', [SettingController::class, 'getDescription'])->name('admin.description');
    Route::match(['get', 'post'], '/admin/description/create', [SettingController::class, 'createDescription'])->name('admin.create-description');
    Route::get('/description/{id}/update', [SettingController::class, 'editDescription'])->name('edit.description');
    Route::put('/description/{id}', [SettingController::class, 'updateDescription'])->name('description.update');
    Route::delete('/description/{id}', [SettingController::class, 'destroyDescription'])->name('description.delete');
    Route::post('/description/toggle-aktif/{id}', [SettingController::class, 'toggleAktifDescription'])->name('description.toggleAktif');

    Route::get('/search/banner', [SettingController::class, 'searchBanner'])->name('banner.search');
    Route::get('/search/user/role', [SettingController::class, 'searchRole'])->name('role.search');
    Route::get('/search/user/manager', [SettingController::class, 'searchUser'])->name('user.search');
    Route::get('/search/menu', [SettingController::class, 'searchMenu'])->name('menu.search');
    Route::get('/search/title', [SettingController::class, 'searchTitle'])->name('title.search');
    Route::get('/search/footer', [SettingController::class, 'searchFooter'])->name('footer.search');
    Route::get('/search/description', [SettingController::class, 'searchDescription'])->name('description.search');
    Route::get('/search/keyword', [SettingController::class, 'searchKeyword'])->name('keyword.search');


    Route::get('/search/video', [VideoController::class, 'search'])->name('video.search');
});

// Add your new routes here
Route::prefix('/RPL')->group(function () {
    Route::get('/', [FormController::class, 'view'])->name('home');
    Route::post('/cetak-form', [CetakFormController::class, 'cetakForm'])->name('cetak-form');
    Route::get('/form-eval', [FormController::class, 'formEval'])->name('form-eval');
    Route::post('/form-eval/cetak', [CetakFormController::class, 'cetakFormEval'])->name('cetak-eval');
    Route::get('/form-cv', [FormController::class, 'formCV'])->name('form-CV');
    Route::post('/form-cv/cetak', [CetakFormController::class, 'cetakFormCV'])->name('cetak-CV');
    Route::get('/CV', [FormController::class, 'testCV'])->name('CV');
    Route::get('/evaluasi', [FormController::class, 'testEval'])->name('evaluasi');
});
