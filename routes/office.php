<?php

use App\Http\Controllers\Office\IndexController;
use App\Livewire\Office\BinaryTree;
use App\Livewire\Office\UnilevelTree;

use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('binary/tree', BinaryTree::class)->name('binary-tree');
Route::get('unilevel/tree', UnilevelTree::class)->name('unilevel-tree');
