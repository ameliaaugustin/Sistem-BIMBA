<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\admin\data\AffiliasiController;
// use App\Http\Controllers\admin\data\CetakPendaftarController;
use App\Http\Controllers\admin\data\PendaftarController;
use App\Http\Controllers\admin\master_data\UserRoleController;
use App\Http\Controllers\admin\data\JadwalBuktiBayarController;
use App\Http\Controllers\admin\master_data\Item_bayarController;
use App\Http\Controllers\admin\master_data\MasterAgamaController;
use App\Http\Controllers\admin\master_data\MasterPaketController;
use App\Http\Controllers\admin\master_data\MasterDokumenController;
use App\Http\Controllers\admin\master_data\MasterPekerjaanController;
use App\Http\Controllers\pendaftar\form_pendaftaran\PilihKBMController;
use App\Http\Controllers\admin\master_data\MasterJamPelajaranController;
use App\Http\Controllers\pendaftar\form_pendaftaran\PendaftaranSiswaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login-auth', [LoginController::class, 'auth'])->name('loginAuth');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register-save', [RegisterController::class, 'saveregist'])->name("saveregist");
});

Route::middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('master-role')->group(function () {
        Route::get('/', [UserRoleController::class, 'index'])->name('master_role');
        Route::get('/create', [UserRoleController::class, 'create'])->name('m_rolecreate');
        Route::post('/savecreate', [UserRoleController::class, 'save'])->name('m_rolesave');
        Route::get('/edit/{id}', [UserRoleController::class, 'edit'])->name('m_roleedit');
        Route::put('/update{id}', [UserRoleController::class, 'update'])->name('m_roleupdate');
        Route::get('/destroy/{id}', [UserRoleController::class, 'destroy'])->name('m_roledestroy');
    });

    Route::prefix('master-agama')->group(function () {
        Route::get('/', [MasterAgamaController::class, 'index'])->name('m_agama');
        Route::get('/create', [MasterAgamaController::class, 'create'])->name('m_agamacreate');
        Route::post('/savecreate', [MasterAgamaController::class, 'save'])->name('m_agamasave');
        Route::get('/edit/{id}', [MasterAgamaController::class, 'edit'])->name('m_agamaedit');
        Route::put('/update{id}', [MasterAgamaController::class, 'update'])->name('m_agamaupdate');
        Route::get('/destroy/{id}', [MasterAgamaController::class, 'destroy'])->name('m_agamadestroy');
    });

    Route::prefix('master-pekerjaan')->group(function () {
        Route::get('/', [MasterPekerjaanController::class, 'index'])->name('m_pekerjaan');
        Route::get('/create', [MasterPekerjaanController::class, 'create'])->name('m_pekerjaancreate');
        Route::post('/savecreate', [MasterPekerjaanController::class, 'save'])->name('m_pekerjaansave');
        Route::get('/edit/{id}', [MasterPekerjaanController::class, 'edit'])->name('m_pekerjaanedit');
        Route::put('/update{id}', [MasterPekerjaanController::class, 'update'])->name('m_pekerjaanupdate');
        Route::get('/destroy/{id}', [MasterPekerjaanController::class, 'destroy'])->name('m_pekerjaandestroy');
    });

    Route::prefix('master-dokumen')->group(function () {
        Route::get('/', [MasterDokumenController::class, 'index'])->name('m_dokumen');
        Route::get('/create', [MasterDokumenController::class, 'create'])->name('m_dokumencreate');
        Route::post('/savecreate', [MasterDokumenController::class, 'save'])->name('m_dokumensave');
        Route::get('/edit/{iPd}', [MasterDokumenController::class, 'edit'])->name('m_dokumenedit');
        Route::put('/update{id}', [MasterDokumenController::class, 'update'])->name('m_dokumenupdate');
        Route::get('/destroy/{id}', [MasterDokumenController::class, 'destroy'])->name('m_dokumendestroy');
    });

    Route::prefix('master-jam-pelajaran')->group(function () {
        Route::get('/', [MasterJamPelajaranController::class, 'index'])->name('m_jam');
        Route::get('/create', [MasterJamPelajaranController::class, 'create'])->name('m_jamcreate');
        Route::post('/savecreate', [MasterJamPelajaranController::class, 'save'])->name('m_jamsave');
        Route::get('/edit/{id}', [MasterJamPelajaranController::class, 'edit'])->name('m_jamedit');
        Route::put('/update/{id}', [MasterJamPelajaranController::class, 'update'])->name('m_jamupdate');
        Route::get('/destroy/{id}', [MasterJamPelajaranController::class, 'destroy'])->name('m_jamdestroy');
        Route::get('/status/{id}/{status}', [MasterJamPelajaranController::class, 'status'])->name('m_jamstatus');
    });

    Route::prefix('master-paket')->group(function () {
        Route::get('/', [MasterPaketController::class, 'index'])->name('m_paket');
        Route::get('/create', [MasterPaketController::class, 'create'])->name('m_paketcreate');
        Route::post('/savecreate', [MasterPaketController::class, 'save'])->name('m_paketsave');
        Route::get('/edit/{id}', [MasterPaketController::class, 'edit'])->name('m_paketedit');
        Route::put('/update{id}', [MasterPaketController::class, 'update'])->name('m_paketupdate');
        Route::get('/destroy/{id}', [MasterPaketController::class, 'destroy'])->name('m_paketdestroy');
    });
    Route::prefix('master-item-bayar')->group(function () {
        Route::get('/', [Item_bayarController::class, 'index'])->name('m_item');
        Route::get('/create', [Item_bayarController::class, 'create'])->name('m_itemcreate');
        Route::post('/savecreate', [Item_bayarController::class, 'save'])->name('m_itemsave');
        Route::get('/edit/{id}', [Item_bayarController::class, 'edit'])->name('m_itemedit');
        Route::put('/update{id}', [Item_bayarController::class, 'update'])->name('m_itemupdate');
        Route::get('/destroy/{id}', [Item_bayarController::class, 'destroy'])->name('m_itemdestroy');
    });



    Route::prefix('master-user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('manajemen_user');
        Route::get('/create', [UserController::class, 'create'])->name('m_usercreate');
        Route::post('/savecreate', [UserController::class, 'save'])->name('m_usersave');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('m_useredit');
        Route::put('/update{id}', [UserController::class, 'update'])->name('m_userupdate');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('m_userdestroy');
    });


    Route::get('/form-pendaftaran', [PendaftaranSiswaController::class, 'index'])->name('form_pendaftaran');
    Route::get('/form-submit', [PendaftaranSiswaController::class, 'upsert'])->name('form_submit');
    Route::put('form-pendaftaran/save-form', [PendaftaranSiswaController::class, 'saveForm'])->name('save_form_pendaftaran');
    Route::put('form-pendaftaran/save-form_ayah', [PendaftaranSiswaController::class, 'saveFormayah'])->name('save_form_ayah');
    Route::put('form-pendaftaran/save-form_ibu', [PendaftaranSiswaController::class, 'saveFormibu'])->name('save_form_ibu');

    Route::get('/form-pilih-jadwal', [PilihKBMController::class, 'index'])->name('form_pilih_jadwal');
    Route::get('/form-pilih-jadwal/get-jadwal', [PilihKBMController::class, 'getJadwal'])->name('getJadwal');
    Route::get('/form-pilih-jadwal/get-price', [PilihKBMController::class, 'getPrice'])->name('getPrice');
    Route::post('/form-pilih-jadwal-save', [PilihKBMController::class, 'saveFormJadwal'])->name('saveFormJadwal');


    Route::get('/form-dokumen', [PendaftaranSiswaController::class, 'formDokumen'])->name('form_dokumen');
    Route::put('/form-dokumen-save', [PendaftaranSiswaController::class, 'saveformDokumen'])->name('save_form_dokumen');

    Route::get('/data-pendaftar', [PendaftarController::class, 'index'])->name('data_pendaftar');
    Route::get('/detail-pendaftar/{id}', [PendaftarController::class, 'detail'])->name('detail_pendaftar');
    Route::put('/update/{id}', [PendaftarController::class, 'update'])->name('update_data_pendaftar');
    // Route::get('/cetakpendaftar', [CetakPendaftarController::class, 'CetakPendaftar'])->name('CetakPendaftar');



    Route::get('/data-jadwal-bukti-bayar', [JadwalBuktiBayarController::class, 'index'])->name('data_jadwal_buktibayar');
    Route::get('/detail-jadwal-bukti-bayar/{id}', [JadwalBuktiBayarController::class, 'detail'])->name('detail_jadwal_buktibayar');
    Route::post('/submit/{id}', [JadwalBuktiBayarController::class, 'update'])->name('update_jadwal_buktibayar');

    Route::get('/data-affiliasi', [AffiliasiController::class, 'index'])->name('data_affiliasi');




    Route::get('/excel-data-pendaftar/{status}', [PendaftarController::class, 'excel'])->name('cetak_data_pend');
    Route::get('/excel-data-jadwal-buktibayar/{status_bayar}', [JadwalBuktiBayarController::class, 'excel'])->name('cetak_data_jadwalbuktibayar');
    Route::get('/excel-data-afiliasi/{role_search}', [AffiliasiController::class, 'excel'])->name('cetak_data_affiliasi');


    Route::get('validasi-pendaftar/{user}', [HomeController::class, 'getStatus'])->name('get_status');
    Route::get('validasi-pembayaray/{user}', [HomeController::class, 'getStatuspembayaran'])->name('get_status_pembayaran');
});














// Route::prefix('master-pekerjaan')->group(function(){
//     Route::get('/', [MasterPekerjaanController])
// });





//halaman single isi blog

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
