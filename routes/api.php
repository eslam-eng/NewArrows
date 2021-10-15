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
    Route::get('/categories/{name}','CategoryController@index');
    Route::post('/categories/create/{name}','CategoryController@create');
    Route::get('/categories/products/{id}/{name}','CategoryController@getCategoryProducts');
    Route::post('/categories/update/{id}','CategoryController@update');
    Route::post('/categories/delete/{id}','CategoryController@delete');

//    End Categories Routes --------------------------------------------------------

//    Coupon Routes-----------------------------------------------------------------------
    Route::get('/coupons/{name}','CouponController@index');
    Route::post('/coupons/create/{name}','CouponController@create');
    Route::post('/coupons/update/{id}','CouponController@update');
    Route::post('/coupons/delete/{id}','CouponController@delete');
    Route::post('/coupons/discount/{name}','CouponController@getPromoCode');

//   End Coupon Routes-----------------------------------------------------------------------

//   Start Products Routes-----------------------------------------------------------------------
     Route::get('/products/{name}','ProductController@index');
     Route::post('/products/create/{name}','ProductController@create');
     Route::post('/products/update/{id}','ProductController@update');
     Route::post('/products/delete/{id}','ProductController@delete');
     Route::get('/product/{id}','ProductController@getProductById');
//   End Components food Routes-----------------------------------------------------------------------


//   Start Products Routes-----------------------------------------------------------------------
    Route::get('/socials/{name}','SocialMediaController@index');
    Route::post('/socials/create/{name}','SocialMediaController@create');
    Route::post('/socials/update/{id}','SocialMediaController@update');
    Route::post('/socials/delete/{id}','SocialMediaController@update');
//   End Components food Routes-----------------------------------------------------------------------

//   Start Products Routes-----------------------------------------------------------------------
    Route::get('/basic-informations/{name}','RestaurantBaiscInfoController@index');
    Route::post('/basic-informations/create/{name}','RestaurantBaiscInfoController@create');
    Route::post('/basic-informations/update/{id}','RestaurantBaiscInfoController@update');
    Route::post('/basic-informations/delete/{id}','RestaurantBaiscInfoController@update');
//   End Components food Routes-----------------------------------------------------------------------



//   Start Branches Routes-----------------------------------------------------------------------
    Route::get('/branches/{name}','BranchController@index');
    Route::get('/restaurant/branches/{name}','BranchController@getBranchByRestaurantId');
    Route::post('/branches/create/{name}','BranchController@create');
    Route::post('/branches/update/{id}','BranchController@update');
    Route::post('/branches/delete/{id}','BranchController@delete');
//   End Components food Routes-----------------------------------------------------------------------

//   Start Branches Routes-----------------------------------------------------------------------
    Route::get('/drinks/{name}','DrinkController@index');
    Route::post('/drinks/create/{name}','DrinkController@create');
    Route::post('/drinks/update/{id}','DrinkController@update');
    Route::post('/drinks/delete/{id}','DrinkController@delete');
//   End Components food Routes-----------------------------------------------------------------------

//   Start ADS Routes-----------------------------------------------------------------------
    Route::get('/ads/{name}','AnnouncementController@index');
    Route::post('/ads/create/{name}','AnnouncementController@create');
    Route::post('/ads/update/{id}','AnnouncementController@update');
    Route::post('/ads/delete/{id}','AnnouncementController@delete');
//   End Components food Routes-----------------------------------------------------------------------

//   Start accounts Routes-----------------------------------------------------------------------
    Route::get('/accounts/{name}','AccountController@index');
    Route::post('/accounts/create/{name}','AccountController@create');
    Route::post('/accounts/update/{id}','AccountController@update');
    Route::post('/accounts/delete/{id}','AccountController@delete');
//   End Components food Routes-----------------------------------------------------------------------



});
