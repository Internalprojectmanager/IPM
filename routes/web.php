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
    Route::get('/details/{name}', 'CompanyController@detailsCompany')->name('companydetails');
    Route::get('/add', 'CompanyController@addCompany')->name('addcompany');
    Route::post('/add', 'CompanyController@storeCompany')->name('storecompany');
    Route::get('/edit/{name}', 'CompanyController@editCompany')->name('editcompany');
    Route::post('/edit/{name}', 'CompanyController@updateCompany')->name('updatecompany');
    Route::get('/delete/{name}', 'CompanyController@deleteCompany')->name('deletecompany');
});

Route::group(['prefix' => 'project'], function (){
   Route::get('/overview', 'ProjectController@overviewProject')->name('overviewproject');
   Route::get('/add', 'ProjectController@addProject')->name('addproject');
   Route::post('/add', 'ProjectController@storeProject')->name('storeproject');
});

//Route::group(['prefix' => ''], function () {