<?php


use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Auth\LoginForm;
use App\Livewire\Master\RoleCrud;
use App\Livewire\Master\UserCrud;
use App\Livewire\Master\BarangCrud;
use App\Livewire\Master\VendorCrud;
use App\Livewire\Master\SatuanCrud;
use App\Livewire\Master\MarginPenjualan;
use App\Livewire\Master\Pengadaan;
use App\Livewire\Master\DetailPengadaan;

Route::get('/', function() {
    return view('welcome');
});

Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/login', LoginForm::class)->name('login')->middleware('guest');
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

Route::prefix('master')->group(function () {
    Route::get('role',   RoleCrud::class)->name('master.role');
    Route::get('user',   UserCrud::class)->name('master.user');
    Route::get('vendor', VendorCrud::class)->name('master.vendor');
    Route::get('satuan', SatuanCrud::class)->name('master.satuan');
    Route::get('barang', BarangCrud::class)->name('master.barang');
    route::get('MarginPenjualan', MarginPenjualan::class)->name('master.marginPenjualan');
});

route::prefix('transaction')->group(function(){
    route::get('pengadaan', Pengadaan::class)->name('master.pengadaan');
    Route::get('pengadaan/{id}/detail', DetailPengadaan::class)->name('transaction.pengadaan.detail');
});
