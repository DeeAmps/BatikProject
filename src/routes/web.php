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

Route::get('/', "HomeController@index")->name("home");
Route::post('/', 'HomeController@checkout')->name("checkout");
Route::get('/contact', 'HomeController@contact')->name("contact");
Route::post('/contact', 'HomeController@submitContact')->name("submit_message");
Route::get('/cart', 'HomeController@cart')->name("cart");
Route::post('/cart', 'HomeController@checkout')->name("checkout");
Route::get('/admin', 'AdminController@index')->name("admin");
Auth::routes();



