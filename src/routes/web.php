<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PurchaseController;

Route::get('/', [ItemController::class, 'index'])->name('items.index');
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('items.show');

Route::middleware('auth')->group(function (){
    
    // 出品
    Route::get('/sell', [ItemController::class, 'create'])->name('items.create');
    Route::post('/sell', [ItemController::class, 'store'])->name('items.store');

    // プロフィール
    Route::get('/mypage', [ProfileController::class, 'index'])->name('mypage.index');
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');

    // 商品購入
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'purchase'])->name('purchase');
    Route::post('/purchase', [PurchaseController::class, 'store'])->name('purchase.store');

    Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'address'])->name('purchase.address');
    Route::post('/purchase/address/{item_id}', [PurchaseController::class, 'update'])->name('purchase.update');

    // コメント
    Route::post('/item/{item_id}/comments', [CommentController::class, 'store'])->name('comments.store');

    // いいね
    Route::post('/item/{item_id}/like', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/item/{item_id}/like', [LikeController::class, 'destroy'])->name('like.destroy');
});









