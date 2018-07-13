<?php

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

Route::get('/', function () {
    return redirect('/films');
});

Route::resource('/films', 'FilmController')->only([
    'create', 'store'
])->middleware('auth');

Route::resource('/films', 'FilmController')->only([
    'index', 'show'
])->middleware(['web']);


Route::resource('films.comments', 'FilmCommentController')->only([
    'index'
])->middleware('web');

Route::resource('films.comments', 'FilmCommentController')->only([
    'store'
])->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
