<?php

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

    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::get('/articles', 'App\Http\Controllers\ArticleController@index')->name('articles');
    Route::get('/articles/{id}', 'App\Http\Controllers\ArticleController@show')->name('article.view');
    Route::post('/save-article', 'App\Http\Controllers\ArticleController@saveArticle')->name('save-article');

});



