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
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Auth::routes();
Route::group(['prefix' => 'company'], function (){
    Route::get('/overview', 'CompanyController@overviewCompany')->name('overviewcompany');
    Route::get('/add', 'CompanyController@addCompany')->name('addcompany');
    Route::post('/add', 'CompanyController@storeCompany')->name('storecompany');
    Route::get('/delete', 'CompanyController@deleteCompany')->name('deletecompany');
});



//Route::group(['prefix' => ''], function () {