<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

    Route::resource('user', UserController::class)->except('show');
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'password'])->name('profile.password');

    Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('article.view');
    Route::post('/save-article', [ArticleController::class, 'saveArticle'])->name('save-article');
    Route::delete('/remove-article/{articleTitle}', [ArticleController::class, 'removeSavedArticle'])->name('remove-article');
});



