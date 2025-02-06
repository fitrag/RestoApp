<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Menu;
use App\Livewire\KategoriMenu;
use App\Livewire\MenuIndex;

Route::get('/menu', MenuIndex::class)->name('list-menu');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/counter', Counter::class);
Route::get('/kategori-menu', KategoriMenu::class)->name('kategori-menu');
