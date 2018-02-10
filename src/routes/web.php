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

Route::prefix('mediamanager')
     ->namespace('Thesold\LaravelMediaManager\Http\Controllers')
     ->middleware(['cors'])
     ->group(function () {
         Route::post('resources/upload/{type?}', 'MediaController@store')->name('upload');
         Route::delete('resources/delete/{id?}', 'MediaController@destroy')->name('delete');

         Route::get('resources/{type?}/{mode?}/{width?}/{height?}/{gravity?}', 'MediaController@resources')
            ->name('profile');
     });
