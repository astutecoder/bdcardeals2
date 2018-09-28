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
    return view('backend.partials.layout');
})->name('admin');

Route::prefix('cars')->group(function () {
    Route::get('all-brands', 'Backend\CarsController@all_brands');
    Route::post('add-brand', 'Backend\CarsController@add_brand');

    Route::get('all-body-types', 'Backend\CarsController@all_body_types');
    Route::post('add-body-type', 'Backend\CarsController@add_body_type');

    Route::get('all-fuel-types', 'Backend\CarsController@all_fuel_types');
    Route::post('add-fuel-type', 'Backend\CarsController@add_fuel_type');

    Route::get('all-colors', 'Backend\CarsController@all_colors');
    Route::post('add-color', 'Backend\CarsController@add_color');

    Route::get('all-cars', 'Backend\CarsController@all_cars');
    Route::get('add-car', 'Backend\CarsController@add_car_form')->name('add-car');
    Route::post('add-car', 'Backend\CarsController@add_car')->name('post-add-car');
});