<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Master\RoleCrud;
use App\Livewire\Master\UserCrud;
use App\Livewire\Master\BarangCrud;
use App\Livewire\Master\VendorCrud;
use App\Livewire\Master\SatuanCrud;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

Route::prefix('master')->group(function () {
    Route::get('role',   RoleCrud::class)->name('master.role');
    Route::get('user',   UserCrud::class)->name('master.user');   // tabel `user`
    Route::get('vendor', VendorCrud::class)->name('master.vendor');
    Route::get('satuan', SatuanCrud::class)->name('master.satuan');
    Route::get('barang', BarangCrud::class)->name('master.barang');
});