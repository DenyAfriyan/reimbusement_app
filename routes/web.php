<?php

use App\Http\Controllers\ApprovalReimbursementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterData\DepartementController;
use App\Http\Controllers\MasterData\JabatanController;
use App\Http\Controllers\MasterData\JenisLimbahController;
use App\Http\Controllers\MasterData\KategoriPengeluaranController;
use App\Http\Controllers\MasterData\MetodePembayaranController;
use App\Http\Controllers\MasterData\SumberLimbahController;
use App\Http\Controllers\MasterData\VendorController;
use App\Http\Controllers\ReimbursementController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Transaksi\PermintaanPengambilanController;
use App\Http\Controllers\Transaksi\PenerimaanController;
use App\Http\Controllers\Transaksi\PengeluaranController;
use App\Http\Controllers\UserManagement\UserController;
use App\Models\KategoriPengeluaran;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class,'index']);

    //master data
    Route::resource('master-data/departement',DepartementController::class);
    Route::resource('master-data/jabatan',JabatanController::class);
    Route::resource('master-data/kategori-pengeluaran',KategoriPengeluaranController::class);
    Route::resource('master-data/metode-pembayaran',MetodePembayaranController::class);

    //reimbursement
    Route::resource('reimbursement',ReimbursementController::class);

    //approval reimbursement
    Route::resource('approval-reimbursement',ApprovalReimbursementController::class);
    Route::post('approval-reimbursement-setujui/{id}',[ApprovalReimbursementController::class,'setujui'])->name('reimbursement.setujui');
    Route::post('approval-reimbursement-ditolak/{id}',[ApprovalReimbursementController::class,'ditolak'])->name('reimbursement.ditolak');

    //users
    Route::resource('user-management/user',UserController::class);

    //report
    Route::get('report',[ReportController::class,'index']);
    Route::get('report-datatable',[ReportController::class,'datatable']);
    Route::get('report/export/{start_limbah_masuk}/{end_limbah_masuk}/{start_limbah_keluar}/{end_limbah_keluar}', [ReportController::class, 'export']);
    Route::get('report/export/{start_limbah_masuk}/{end_limbah_masuk}/{start_limbah_keluar}/{end_limbah_keluar}/{jenis_limbah_id}', [ReportController::class, 'exportPerItem']);
});


Route::get('/sign-in',[AuthController::class, 'index'])->name('login');
Route::post('/sign-in',[AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/sign-out',[AuthController::class, 'logout'])->name('logout');
