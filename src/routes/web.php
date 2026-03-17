<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function (){

    Route::get('/', [AuthController::class, 'index']);



    // プロフィール
    Route::get('/mypage', function () {
        return view('mypage.index');
    });
    Route::get('/mypage/profile', [ProfileController::class, 'create'])->name('profile.create');

    Route::post('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');

    // 商品購入
    Route::get('/purchase/{item_id}', function () {
        return view('purchase.index');
    });
    Route::get('/purchase/address/{item_id}', function () {
        return view('purchase.address');
    });




});

Route::get('/', [ProductController::class, 'index']);
Route::get('/item/{item_id}', [ProductController::class, 'show']);

Route::get('/sell', function () {
    return view('sell');
});



