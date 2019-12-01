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
    $items = App\Product::all();
    return view('frontstore', compact('items'));
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

Route::resource('products', 'AdminController');

Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
});


Route::get('/bid/{id}', 'FrontstoreController@bidPage');
Route::post('/store', 'FrontstoreController@storeBid');

Route::get('/highest', 'FrontstoreController@highestBid');
