<?php

use App\Http\Controllers\Office\IndexController;
use App\Livewire\Office\BinaryTree;
use App\Livewire\Office\UnilevelTree;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
}); */


Route::get('/', function () {
    return view('index');
})->name('index');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('office/index', [IndexController::class, 'index'])->name('office.index');
    Route::get('binary/tree', BinaryTree::class)->name('office.binary-tree');
    Route::get('unilevel/tree', UnilevelTree::class)->name('office.unilevel-tree');
});

Route::get('register/{sponsor}/{side}', Register::class)->name('register');
