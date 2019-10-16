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
Route::get('/complete/{id}', 'ChargesController@complete');



Auth::routes();
Route::get('/bookstore', function(){
    return view('bookstore');
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'BooksController@index')->name('home');
    Route::resource('books', 'BooksController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('authors', 'AuthorsController');
    Route::post('/bookauthors', 'AuthorsController@booksstore');
});


