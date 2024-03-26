<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\PopularCardJobController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Routing\Middleware\ThrottleRequests;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Маршруты для aytentif
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

// Маршруты для posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get("/posts/{post}", [PostController::class, 'show'])->name('posts.show');

// Маршруты для wishlist
Route::get('/wishlist/{user}', [WishlistController::class, 'index']);
Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::delete('/wishlist/remove', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');

// Маршруты для popularJobCard
Route::get('/popularJobCard', [PopularCardJobController::class, 'index'])->name('popularJobCard.index');

// Маршруты для resumes
Route::get('/resume/{user}', [ResumeController::class, 'index'])->name('resume.index');
Route::post('/resume/add/{user}', [ResumeController::class, 'store'])->name('resume.store');
Route::put('/resume/edit/{resume}', [ResumeController::class, 'upgrade'])->name('resume.upgrade');
Route::delete('/resume/{resume}', [ResumeController::class, 'destroy'])->name('resume.destroy');
Route::get('/resume/{user}/{resume}', [ResumeController::class, 'show'])->name('resume.show');

// Маршруты для response
Route::get('/response/{user}', [ResponseController::class, 'index'])->name('response.index');
Route::post('/response/add/', [ResponseController::class, 'store'])->name('response.store');
Route::delete('/response/{response}', [ResponseController::class, 'destroy'])->name('response.destroy');
