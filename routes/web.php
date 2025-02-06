<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Menu;
use App\Livewire\KategoriMenu;
use App\Livewire\MenuIndex;
use App\Livewire\CouponIndex;
use App\Livewire\HomeIndex;
use App\Livewire\DiscountList;

Route::get('/home', HomeIndex::class)->name('home');
Route::get('/diskon', DiscountList::class)->name('diskon');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/menu', MenuIndex::class)->name('admin.list-menu');
Route::get('/admin/kategori-menu', KategoriMenu::class)->name('admin.kategori-menu');
Route::get('/admin/kupon', CouponIndex::class)->name('admin.kupon');
