<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BlogEntriesController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\UserFollowController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BlogEntriesController::class, 'index'])->name('dashboard');
Route::get('show/{id}', [BlogEntriesController::class, 'show'])->name('blog_entries.show');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('blog_entries', BlogEntriesController::class, ['except' => ['show']]);
    Route::get('user/{user_id}', [UsersController::class, 'index'])->name('user.index');
    Route::post('update', [UsersController::class, 'update'])->name('user.update');
    Route::post('follow', [UserFollowController::class, 'store'])->name('follow');
    Route::delete('unfollow', [UserFollowController::class, 'destroy'])->name('unfollow');
    Route::post('favorite', [FavoritesController::class, 'store'])->name('favorite');
    Route::delete('unfavorite', [FavoritesController::class, 'destroy'])->name('unfavorite');
});

require __DIR__.'/auth.php';
