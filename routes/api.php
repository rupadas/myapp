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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group (
    [
        'prefix' => 'v1'
    ]
    , 
    function () {

    //Image Upload
    Route::post('images', 'ImageController@createBlob');

    //Get Sellers
    Route::get('sellers', 'SellerController@index');

    //Send Email
    Route::post('seller/{id}/sendEmail', 'SellerController@sendEmail')->where('id', '[0-9]+');

    //Get vehicles Listings
    Route::get('listings', 'VehicleController@index');

    Route::post('listings/search', 'VehicleController@search');

    //Show Vehicle Details
    Route::get('listing/{id}', 'VehicleController@show')->where('id', '[0-9]+');

    //Get Seller Reviews
    Route::get('listing/{id}/reviews', 'VehicleController@reviews')->where('id', '[0-9]+');
});
