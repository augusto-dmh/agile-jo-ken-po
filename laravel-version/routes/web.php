<?php

use App\Livewire\JoKenPo;
use App\Livewire\JoKenPoXLuckMode;
use App\Livewire\Leadership;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/play/simple-mode', JoKenPo::class)->name('play-simple-mode');

Route::get('/play/x-luck-mode', JoKenPoXLuckMode::class)->name('play-x-luck-mode');

Route::get('/leadership', Leadership::class)->name('leadership');

require __DIR__.'/auth.php';
