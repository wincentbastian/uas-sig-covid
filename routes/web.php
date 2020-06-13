<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/test', function(){
    return view('test');
});

Route::get('/', 'HomeController@index');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/gradient', 'HomeController@gradient');
Route::resource('/admin/pasien','PasienController');

Route::prefix('admin')->group(function () {
  
    Route::get('/pasien', 'PasienController@index')->name('pasien');
    Route::post('/pasien', 'PasienController@store')->name('pasien-store');
    Route::get('/pasien/{tanggal}', 'PasienController@show')->name('pasien-show');
    Route::put('/pasien/{id}', 'PasienController@update')->name('pasien-update');
    Route::delete('/pasien/{id}', 'PasienController@destroy')->name('pasien-delete');



    Route::get('/kabupaten', 'KabupatenController@index')->name('kabupaten');

});
