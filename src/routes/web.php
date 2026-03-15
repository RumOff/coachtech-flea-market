<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index']);
Route::get('/item/{item_id}', [ProductController::class, 'show']);

Route::get('/sell', function () {
    return view('sell');
});


Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/login', function () {
    return view('auth.login');
});

// プロフィール
Route::get('/mypage', function () {
    return view('mypage.index');
});
Route::get('/mypage/profile', function () {
    return view('mypage.profile');
});

// 商品購入
Route::get('/purchase/{item_id}', function () {
    return view('purchase.index');
});
Route::get('/purchase/address/{item_id}', function () {
    return view('purchase.address');
});