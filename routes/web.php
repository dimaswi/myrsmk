<?php

use Illuminate\Http\Request;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\EmailVerificationController;

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

//General
Route::get('/',function () {
    return redirect('/login');
});
Route::get('/home', App\Http\Livewire\HomeLivewire::class)->name('home')->middleware('auth');
Route::get('/profile/{userID}', App\Http\Livewire\ProfileLivewire::class)->name('profile');
Route::get('/stats', App\Http\Livewire\StatsLivewire::class)->name('stats')->middleware('auth');

//Logbook
Route::get('/logbook', App\Http\Livewire\Logbook\LogbookIndex::class)->name('logbook')->middleware('auth');
Route::get('/logbook/detail/{uid}', App\Http\Livewire\Logbook\LogbookDetail::class)->name('logbook_detail')->middleware('auth');
Route::get('/logbook/create', App\Http\Livewire\Logbook\LogbookCreate::class)->name('logbook_create')->middleware('auth');

//Mastering
Route::get('/admin/users', App\Http\Livewire\Master\Users::class)->name('admin_users')->middleware('auth');
Route::get('/admin/unit', App\Http\Livewire\Master\KepalaUnit::class)->name('admin_unit')->middleware('admin');
Route::get('/admin/bagian', App\Http\Livewire\Master\KepalaBagian::class)->name('admin_bagian')->middleware('admin');
Route::get('/admin/role', App\Http\Livewire\Master\Roles::class)->name('admin_roles')->middleware('admin');
Route::get('/admin/permission', App\Http\Livewire\Master\Permissions::class)->name('admin_permission')->middleware('admin');
Route::get('/admin/jam', App\Http\Livewire\Master\JamKerja::class)->name('admin_jam_kerja')->middleware('admin');
Route::get('/admin/ip', App\Http\Livewire\Admin\IPAddress::class)->name('admin_ip')->middleware('admin');
Route::get('/notifications', App\Http\Livewire\CentralNotificationsLivewire::class)->name('central_notifications')->middleware('auth');

//Pengadaan
Route::get('/logistik', App\Http\Livewire\Pengadaan\PengadaanIndex::class)->name('logistik')->middleware('admin');

//Stok
Route::get('/stok', App\Http\Livewire\Stok\Logistik::class)->name('logistik')->middleware('admin');

//Permintaan
Route::get('/permintaan', App\Http\Livewire\Permintaan\Permintaan::class)->name('permintaan')->middleware('admin');

Route::get('/exit', function () {
    Auth::logout();

    return redirect('/');
});

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});

Route::get('/billing-portal', function (Request $request) {
    //Auth::user()->createAsStripeCustomer();
    return $request->user()->redirectToBillingPortal();
});

//webhook
Route::get('/api/qvapay/pay/', [\App\Http\Controllers\QvaPayController::class, 'webhook']);
Route::get('/api/qvapay/cancel', [\App\Http\Controllers\QvaPayController::class, 'cancel']);
