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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('api')->prefix('v1')->group(function(){
    Route::get('all-cars', 'Backend\CarsController@all_cars');
    Route::get('get-car/{id}', 'Backend\CarsController@get_single_car');
    Route::get('all-brands', 'Backend\BrandsController@all_brands');
    Route::get('all-body-types', 'Backend\BodyTypesController@all_body_types');
});

Route::middleware('api')->prefix('v1/album')->group(function(){
   Route::get('all-photos/{car_id}', 'Backend\PhotoController@get_all_photos');
});
Route::middleware('auth:api')->prefix('v1/album')->group(function () {
    Route::post('change-cover', 'Backend\PhotoController@change_cover');
    Route::post('append-image', 'Backend\PhotoController@append_image');
    Route::post('delete-image', 'Backend\PhotoController@delete_image');
});