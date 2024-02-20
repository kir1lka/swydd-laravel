<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\PopularCardJobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Routing\Middleware\ThrottleRequests;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware([ThrottleRequests::class])->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get("/posts/{post}", [PostController::class, 'show'])->name('posts.show');

    // Маршруты для wishlist
    Route::get('/wishlist/{user}', [WishlistController::class, 'index']);
    Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::delete('/wishlist/remove', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');

    Route::get('/popularJobCard', [PopularCardJobController::class, 'index'])->name('popularJobCard.index');
});
