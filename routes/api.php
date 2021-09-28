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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => 'api', 'prefix' => 'auth', 'namespace'=>'Api'], function () {

//    auth user -----------------------------------------------------------

    Route::post('/login','AuthController@login');
    Route::post('/register','AuthController@register');
    Route::post('/logout','AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::get('/user-profile','AuthController@me');
//
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'dashboard', 'namespace'=>'Api'],function (){

//   Categories ------------------------------------------------------------
    Route::get('/categories','CategoryController@index');
    Route::post('/category/create','CategoryController@create');
    Route::get('/category/{id}/products','CategoryController@getCategoryProducts');
    Route::post('/category/update/{id}','CategoryController@update');
    Route::post('/category/delete/{id}','CategoryController@delete');

//    End Categories Routes --------------------------------------------------------

//    Coupon Routes-----------------------------------------------------------------------
    Route::get('/coupons','CouponController@index');
    Route::post('/coupons/create','CouponController@create');
    Route::post('/coupons/update/{id}','CouponController@update');
    Route::post('/coupons/delete/{id}','CouponController@delete');
    Route::post('/coupons/discount','CouponController@getPromoCode');

//   End Coupon Routes-----------------------------------------------------------------------

//   Start Products Routes-----------------------------------------------------------------------
     Route::get('/products','ProductController@index');
     Route::post('/products/create','ProductController@create');
     Route::post('/products/update/{id}','ProductController@update');
     Route::post('/products/delete/{id}','ProductController@delete');
     Route::get('/products/{id}','ProductController@getProductById');
//   End Components food Routes-----------------------------------------------------------------------


//   Start Products Routes-----------------------------------------------------------------------
    Route::get('/socials','SocialMediaController@index');
    Route::post('/socials/create','SocialMediaController@create');
    Route::post('/socials/update/{id}','SocialMediaController@update');
    Route::post('/socials/delete/{id}','SocialMediaController@update');
//   End Components food Routes-----------------------------------------------------------------------

//   Start Products Routes-----------------------------------------------------------------------
    Route::get('/basic-informations','RestaurantBaiscInfoController@index');
    Route::post('/basic-informations/create','RestaurantBaiscInfoController@create');
    Route::post('/basic-informations/update/{id}','RestaurantBaiscInfoController@update');
    Route::post('/basic-informations/delete/{id}','RestaurantBaiscInfoController@update');
//   End Components food Routes-----------------------------------------------------------------------


});
