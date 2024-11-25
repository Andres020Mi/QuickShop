<?php

use App\Http\Controllers\BuyersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


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

    Route::delete("seller/products/{id}",[SellerController::class,"destroy"])->name("seller.products.delete");
    Route::post("seller/products/{id}",[SellerController::class,"edit"])->name("seller.products.edit");
    Route::put("seller/products/{id}",[SellerController::class,"update"])->name("seller.products.update");
});

require __DIR__.'/auth.php';
