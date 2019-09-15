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
Route::get('/books', 'BooksApiController@index');
Route::get('/categories', 'BooksApiController@catindex');
Route::post('/charge', 'ChargesController@index');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
