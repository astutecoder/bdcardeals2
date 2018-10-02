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
    Route::get('all-cars', 'Backend\CarsController@all_cars')->name('all-cars');
    Route::get('add-car', 'Backend\CarsController@create')->name('add-car');
    Route::get('edit/{id?}', 'Backend\CarsController@edit')->name('edit-car');

    Route::post('add-car', 'Backend\CarsController@store')->name('store-car');
    Route::post('edit', 'Backend\CarsController@update')->name('update-car');

    Route::prefix('albums')->group(function () {
        Route::get('/', 'Backend\AlbumController@index')->name('albums');
        Route::get('/{album_id}', 'Backend\AlbumController@show')->name('view-album');
        Route::get('create/{car_id}', 'Backend\PhotoController@create')->name('create-album');
        Route::get('edit/{car_id}', 'Backend\PhotoController@edit')->name('edit-album');

        Route::post('add-album', 'Backend\PhotoController@store')->name('store-album');
        Route::post('edit', 'Backend\PhotoController@update')->name('update-album');
    });
});

Route::prefix('brands')->group(function () {
    Route::get('all-brands', 'Backend\BrandsController@all_brands')->name('all-brands');
    Route::get('add-brand', 'Backend\BrandsController@create')->name('add-brand');
    Route::get('edit/{id?}', 'Backend\BrandsController@edit')->name('edit-brand');

    Route::post('add-brand', 'Backend\BrandsController@store')->name('store-brand');
    Route::post('edit', 'Backend\BrandsController@update')->name('update-brand');
});

Route::prefix('body-types')->group(function () {
    Route::get('all-body-types', 'Backend\BodyTypesController@all_body_types')->name('all-body-types');
    Route::get('add-body-type', 'Backend\BodyTypesController@create')->name('add-body-type');
    Route::get('edit/{id?}', 'Backend\BodyTypesController@edit')->name('edit-body-types');

    Route::post('add-body-type', 'Backend\BodyTypesController@store')->name('store-body-type');
    Route::post('edit', 'Backend\BodyTypesController@update')->name('update-body-type');
});

Route::prefix('fuel-types')->group(function () {
    Route::get('all-fuel-types', 'Backend\FuelTypesController@all_fuel_types')->name('all-fuel-types');
    Route::get('add-fuel-type', 'Backend\FuelTypesController@create')->name('add-fuel-type');
    Route::get('edit/{id?}', 'Backend\FuelTypesController@edit')->name('edit-fuel-type');

    Route::post('add-fuel-type', 'Backend\FuelTypesController@store')->name('store-fuel-type');
    Route::post('edit', 'Backend\FuelTypesController@update')->name('update-fuel-type');
});

Route::prefix('colors')->group(function () {
    Route::get('all-colors', 'Backend\ColorsController@all_colors')->name('all-colors');
    Route::get('add-color', 'Backend\ColorsController@create')->name('add-color');
    Route::get('edit/{id?}', 'Backend\ColorsController@edit')->name('edit-color');

    Route::post('add-color', 'Backend\ColorsController@store')->name('store-color');
    Route::post('edit', 'Backend\ColorsController@update')->name('update-color');
});

Route::prefix('sources')->group(function () {
    Route::get('all-sources', 'Backend\SourcesController@all_sources')->name('all-sources');
    Route::get('add-source', 'Backend\SourcesController@create')->name('add-source');
    Route::get('edit/{id?}', 'Backend\SourcesController@edit')->name('edit-source');

    Route::post('add-source', 'Backend\SourcesController@store')->name('store-source');
    Route::post('edit', 'Backend\SourcesController@update')->name('update-source');
});