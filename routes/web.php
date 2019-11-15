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
Route::get('/bookstore', 'BookStoreController@index');
Route::post('/bookstore/add/{book}', 'BookStoreController@addToCart');
Route::get('/cart', 'BookStoreController@cart');
Route::post('/cart/remove/{id}', 'BookStoreController@cartRemove');
Route::post('/updateItemQuantity/{id}', 'BookStoreController@cartUpdate');
Route::get('/checkout', 'BookStoreController@checkout');
Route::get('/success', function () {
    return view('success2');
});
Route::post('/checkout', 'ChargesController@index');
Route::get('donate', 'DonateController@index'); 
Route::post('donate', 'DonateController@submit');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'BooksController@index')->name('home');
    Route::resource('books', 'BooksController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('authors', 'AuthorsController');
    Route::post('/bookauthors', 'AuthorsController@booksstore');
});


