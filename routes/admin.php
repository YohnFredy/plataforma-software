<?php

use App\Http\Controllers\Admin\IndexController;
use App\Livewire\Admin\CategoryCrud;
use App\Livewire\Admin\CategoryIndex;
use App\Livewire\Admin\ProductCrud;
use App\Livewire\Admin\ProductIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('dashboard');
Route::get('categorias', CategoryIndex::class)->name('categories.index');
Route::get('categories/create', CategoryCrud::class)->name('categories.create');
Route::get('categories/{category}/edit', CategoryCrud::class)->name('categories.edit');
Route::get('/products', ProductIndex::class)->name('products.index');
Route::get('/products/create', ProductCrud::class)->name('products.create');
Route::get('/products/{product}/edit', ProductCrud::class)->name('products.edit');

/* 
Route::get('Marca', BrandCotroller::class)->name('brand');

;

Route::get('products/{product}/edit', ProductCrud::class)->name('products.edit'); */