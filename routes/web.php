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
//Route::resource('coupon','couponController');
Route::get('coupon',['as' => 'coupon.index', 'uses' => 'couponController@index']);
Route::get('coupon/create',['as' => 'coupon.create', 'uses' => 'couponController@create']);
Route::post('coupon/store',['as' => 'coupon.store', 'uses' => 'couponController@store']);
Route::get('coupon/show/{id}',['as' => 'coupon.show', 'uses' => 'couponController@show']);
Route::get('coupon/{id}/edit',['as' => 'coupon.edit', 'uses' => 'couponController@edit']);
Route::patch('coupon/update/{id}',['as' => 'coupon.update', 'uses' => 'couponController@update']);
Route::delete('coupon/destroy/{id}',['as' => 'coupon.destroy', 'uses' => 'couponController@destroy']);
Route::post('coupon/coupon_validator',['as' => 'coupon.coupon_validator', 'uses' => 'couponController@coupon_validator']);

Route::get('product',['as' => 'product.index', 'uses' => 'productController@index']);
Route::get('product/create',['as' => 'product.create', 'uses' => 'productController@create']);
Route::post('product/store',['as' => 'product.store', 'uses' => 'productController@store']);
Route::get('product/show/{id}',['as' => 'product.show', 'uses' => 'productController@show'])->middleware('auth');
Route::get('product/{id}/edit',['as' => 'product.edit', 'uses' => 'productController@edit']);
Route::patch('product/update/{id}',['as' => 'product.update', 'uses' => 'productController@update']);
Route::delete('product/destroy/{id}',['as' => 'product.destroy', 'uses' => 'productController@destroy']);

Route::post('cart/store',['as' => 'cart.store', 'uses' => 'cartController@store']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
$this->get('login', 'Auth\AuthController@showLoginForm');
$this->post('login', 'Auth\AuthController@login');
$this->get('logout', 'Auth\AuthController@logout');
// Registration Routes...
$this->get('register', 'Auth\AuthController@showRegistrationForm');
$this->post('register', 'Auth\AuthController@register');
// Password Reset Routes...
$this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
$this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
$this->post('password/reset', 'Auth\PasswordController@reset');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
