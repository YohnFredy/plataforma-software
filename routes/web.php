<?php

use App\Http\Controllers\Office\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WebhookController;
use App\Livewire\Cart;
use App\Livewire\CreateOrder;
use App\Livewire\Office\BinaryTree;
use App\Livewire\Office\UnilevelTree;
use App\Livewire\Products;
use App\Livewire\Register;
use App\Livewire\ShowProduct;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('productos', Products::class)->name('product');
Route::get('producto/{product}', ShowProduct::class)->name('product.show');
Route::get('carrito', Cart::class)->name('product.cart');



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

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/create', CreateOrder::class)->name('orders.create');
    Route::get('orders/{order}/payment', [OrderController::class, 'payment'])->name('orders.payment');
    Route::get('orders/bold/respuesta', [OrderController::class, 'boldResponsePayment'])->name('orders.bold');

    Route::get('orders/{order}/show', [OrderController::class, 'show'])->name('orders.show');
});

Route::post('webhook/bold/payment-status', [WebhookController::class, 'handleBoldWebhook']);
Route::get('register/{sponsor}/{side}', Register::class)->name('registro');
