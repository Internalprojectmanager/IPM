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
    Route::get('/{name}/details', 'CompanyController@detailsCompany')->name('companydetails');
    Route::get('/add', 'CompanyController@addCompany')->name('addcompany');
    Route::post('/add', 'CompanyController@storeCompany')->name('storecompany');
    Route::get('/edit/{name}', 'CompanyController@editCompany')->name('editcompany');
    Route::post('/edit/{name}', 'CompanyController@updateCompany')->name('updatecompany');
    Route::get('/delete/{name}', 'CompanyController@deleteCompany')->name('deletecompany');
});
Route::group(['prefix' => 'project'], function () {
    Route::get('/overview', 'ProjectController@overviewProject')->name('overviewproject');
    Route::get('/add', 'ProjectController@addProject')->name('addproject');
    Route::post('/add', 'ProjectController@storeProject')->name('storeproject');
});
Route::group(['prefix' => 'document'], function (){
   Route::get('/add/{name}/{company_id}', 'DocumentController@addDocument')->name('adddocument');
   Route::post('/add', 'DocumentController@storeDocument')->name('storedocument');
});

Route::group(['prefix' => 'letter'], function (){
    Route::get('/add/{name}/{company_id}', 'LetterController@addLetter')->name('addletter');
    Route::post('/add', 'LetterController@storeLetter')->name('storeletter');
});

Route::post('/release/add', 'ReleaseController@storeRelease')->name('storerelease');


Route::group(['prefix' => '{company_id}'], function () {
    Route::group(['prefix' => 'project'], function (){
        Route::group(['prefix' => '{name}'], function (){
            Route::get('/details', 'ProjectController@detailsProject')->name('projectdetails');
            Route::get('/edit', 'ProjectController@editProject')->name('editproject');
            Route::post('/edit', 'ProjectController@updateProject')->name('updateproject');
            Route::get('/delete', 'ProjectController@deleteProject')->name('deleteproject');
            
            Route::group(['prefix' => '{release_name}'], function (){
                Route::get('/{version}/details', 'ReleaseController@showRelease')->name('showrelease');
                Route::get('/feature', 'FeatureController@add')->name('addfeature');

                Route::post('/feature/store', 'FeatureController@store')->name('storefeature');
            });

            Route::group(['prefix' => 'release'], function (){
                Route::get('/add', 'ReleaseController@addRelease')->name('addrelease');
                Route::post('/add', 'ReleaseController@storeRelease')->name('storerelease');
            });
        });
    });
});