<?php

use App\Livewire\JoKenPo;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/play', JoKenPo::class)->name('play');

require __DIR__.'/auth.php';
