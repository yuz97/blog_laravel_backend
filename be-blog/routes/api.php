<?php

use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Posts\SubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', MeController::class);

    Route::prefix('posts')->namespace('Posts')->group(function () {
        //post
        Route::get('/', [PostController::class, 'index'])->name('post.index')->withoutMiddleware('auth:sanctum');
        Route::post('/create', [PostController::class, 'store'])->name('post.store');
        Route::put('/{post:slug}/edit', [PostController::class, 'update'])->name('post.edit');
        Route::delete('/{post:slug}/delete', [PostController::class, 'destroy'])->name('post.delete');

        //subject
        Route::get('/subjects', [SubjectController::class, 'index'])->name('subject.index')->withoutMiddleware('auth:sanctum');
        Route::get('/subjects/{subject:slug}', [SubjectController::class, 'show'])->name('subject.show')->withoutMiddleware('auth:sanctum');
        Route::get('/{subject:slug}/{post:slug}', [PostController::class, 'show'])->name('posts.show')->withoutMiddleware('auth:sanctum');
    });
});
