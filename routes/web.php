<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\InputDataBill;
use App\Livewire\ValidasiDataBill;
use App\Livewire\RegDatas;
use App\Livewire\Merchant;
use App\Livewire\Dashboard;


Route::get('/', function () {
    return view('home');
});

Route::get('/inputdata', InputDataBill::class)->name('inputDataBill');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');
        Route::get('/regdatas', RegDatas::class)->name('regdatas');
        Route::get('/merchants', Merchant::class)->name('merchants');
        Route::get('/regdatas/{statusid}', RegDatas::class)->name('regdatastatus');
        Route::get('/validasidata/{regid}', ValidasiDataBill::class)->name('validasidata');

require __DIR__.'/auth.php';
