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

Route::group(['middleware' => 'api', 'prefix' => 'dashboard', 'namespace'=>'Api'],function (){

//   upload images route ------------------------------------------------------------

    Route::post('upload/image','UploadImageController@uploadImg');

//   Categories ------------------------------------------------------------
    Route::get('/categories','CategoryController@index');
    Route::post('/category/create','CategoryController@create');
    Route::get('/category/{id}/products','CategoryController@getCategoryProducts');
    Route::post('/category/update/{id}','CategoryController@update');
    Route::post('/category/delete/{id}','CategoryController@delete');

//    End Categories Routes --------------------------------------------------------

//    Coupon Routes-----------------------------------------------------------------------
    Route::get('/coupons','CouponController@index');
    Route::post('/coupons/create/{id}','CouponController@create');
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



//   Start Branches Routes-----------------------------------------------------------------------
    Route::get('/branches','BranchController@index');
    Route::get('/restaurant/branches','BranchController@getBranchByRestaurantId');
    Route::post('/branches/create','BranchController@create');
    Route::post('/branches/update/{id}','BranchController@update');
    Route::post('/branches/delete/{id}','BranchController@delete');
//   End Components food Routes-----------------------------------------------------------------------

//   Start Branches Routes-----------------------------------------------------------------------
    Route::get('/drinks','DrinkController@index');
    Route::post('/drinks/create','DrinkController@create');
    Route::post('/drinks/update/{id}','DrinkController@update');
    Route::post('/drinks/delete/{id}','DrinkController@delete');
//   End Components food Routes-----------------------------------------------------------------------

//   Start ADS Routes-----------------------------------------------------------------------
    Route::get('/ads','AnnouncementController@index');
    Route::post('/ads/create','AnnouncementController@create');
    Route::post('/ads/update/{id}','AnnouncementController@update');
    Route::post('/ads/delete/{id}','AnnouncementController@delete');
//   End Components food Routes-----------------------------------------------------------------------

//   Start accounts Routes-----------------------------------------------------------------------
    Route::get('/accounts','AccountController@index');
    Route::post('/accounts/create','AccountController@create');
    Route::post('/accounts/update/{id}','AccountController@update');
    Route::post('/accounts/delete/{id}','AccountController@delete');
//   End Components food Routes-----------------------------------------------------------------------



});
