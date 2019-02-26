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
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->namespace('Admin')->as('admin.')->middleware(['auth', 'admin'])->group(function () {
//     Route::resource('locations', 'LocationController');
//     Route::resource('products','ProductController');
//     Route::resource('pqrs','PQRController');
    Route::resource('users', 'UserController');
    Route::resource('pages', 'Page1Controller');
    
});


Route::get('/', 'PageController@index');
Route::get('/', 'PageController@index')->name('home');
Route::get('/home', 'PageController@index');

Route::get('/brm/{slug}', 'PageController@show')->name('page');
