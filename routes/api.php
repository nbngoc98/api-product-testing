<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::middleware('auth:api')->get('products', 'Api\ProductController@index')->name('products.index');

    Route::middleware('auth:api')->get('products/{product}', 'Api\ProductController@show')->name('products.show');
    // Thêm sản phẩm mới
    Route::middleware('auth:api')->post('products', 'Api\ProductController@store')->name('products.store');

    Route::middleware('auth:api')->post('products/{product}', 'Api\ProductController@update')->name('products.update');
    Route::middleware('auth:api')->put('products/{product}', 'Api\ProductController@update')->name('products.update');
    Route::middleware('auth:api')->patch('products/{product}', 'Api\ProductController@update')->name('products.update');

    Route::middleware('auth:api')->delete('products/{product}', 'Api\ProductController@destroy')->name('products.destroy');