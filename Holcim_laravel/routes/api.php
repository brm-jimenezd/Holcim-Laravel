<?php

use Illuminate\Http\Request;

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
Auth::routes();

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//**********************************/////////////////////////////////////////*
            //Api Rest routes by holcim 
//*********************************/////////////////////////////////////////*
Route::prefix('api')->namespace('Api')->as('api.')->middleware(['auth', 'api'])->group(function () {
    Route::resource('locations', 'LocationController');
    Route::resource('products','ProductController');
    Route::resource('pqrs','PQRController');
    Route::resource('users', 'UserController');
    Route::resource('static_pages', 'StaticPageController');
});





