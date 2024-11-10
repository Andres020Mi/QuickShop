<?php

use App\Http\Controllers\BuyersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;


Route::get("/",[BuyersController::class,"index"])->name("buyers.index");


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    // vendedor
    Route::get("seller/products",[SellerController::class,"index"])->name("seller.products.index");
    
    Route::get("seller/products/create",[SellerController::class,"create"])->name("seller.products.create");
    Route::post("seller/products/store",[SellerController::class,"store"])->name("seller.products.store");
    
});

require __DIR__.'/auth.php';
