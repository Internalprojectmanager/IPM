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
    return redirect(route('overviewproject'));
});

Route::get('/home', function () {
    return redirect(route('overviewproject'));

})->name('home');

Route::get('/profile', 'ProfileController@viewProfile')->name('profile');
Route::post('/profile', 'ProfileController@updateProfile')->name('saveprofile');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'password'], function () {
    Route::get('/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/request', 'Auth\ResetPasswordController@reset');
    Route::get('/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
});
Route::group(['prefix' => 'client'], function (){
    Route::get('/overview', 'CompanyController@overviewCompany')->name('overviewclient');
    Route::post('/overview', 'CompanyController@searchCompany')->name('searchCompany');
    Route::get('/{name}/details', 'CompanyController@detailsCompany')->name('clientdetails');
    Route::post('/{name}/details', 'CompanyController@detailsSort')->name('clientsorting');
    Route::get('/add', 'CompanyController@addCompany')->name('addclient');
    Route::post('/add', 'CompanyController@storeCompany')->name('storeclient');
    Route::get('/edit/{name}', 'CompanyController@editCompany')->name('editclient');
    Route::post('/edit/{name}', 'CompanyController@updateCompany')->name('updateclient');
    Route::get('/delete/{name}', 'CompanyController@deleteCompany')->name('deleteclient');
});
Route::group(['prefix' => 'project'], function () {
    Route::get('/overview', 'ProjectController@overviewProject')->name('overviewproject');
    Route::post('/overview', 'ProjectController@searchProject')->name('searchproject');
    Route::get('/add', 'ProjectController@addProject')->name('addproject');
    Route::post('/add', 'ProjectController@storeProject')->name('storeproject');
});


Route::post('/release/overview', 'ReleaseController@overviewTestrapport')->name('storerelease');
Route::post('/file/delete/{document_id}', 'DocumentController@deleteFile')->name('deletefile');

Route::group(['prefix' => 'project'], function (){
    Route::group(['prefix' => '{client_id}'], function () {
        Route::group(['prefix' => '{name}'], function (){
            Route::get('/details', 'ProjectController@detailsProject')->name('projectdetails');
            Route::get('/edit', 'ProjectController@editProject')->name('editproject');
            Route::post('/edit', 'ProjectController@updateProject')->name('updateproject');
            Route::get('/delete', 'ProjectController@deleteProject')->name('deleteproject');

            Route::group(['prefix' => 'documents'], function () {
                Route::get('/', 'DocumentController@overviewDocuments')->name('documentoverview');
                Route::get('/add', 'DocumentController@addDocument')->name('adddocument');
                Route::put('/add', 'DocumentController@storeDocument')->name('storedocument');
                Route::get('/show/{document_id}', 'DocumentController@showDocument')->name('showdocument');
                Route::get('/edit/{document_id}', 'DocumentController@editDocument')->name('editdocument');
                Route::put('/edit/{document_id}', 'DocumentController@updateDocument')->name('updatedocument');
                Route::get('/delete/{id}', 'DocumentController@deleteDocument')->name('deletedocument');
                Route::get('/download/{id}', 'DocumentController@downloadFile')->name('downloadfile');

            });



            Route::group(['prefix' => '{release_name}'], function (){
                Route::get('/{version}/details', 'ReleaseController@showRelease')->name('showrelease');
                Route::get('/edit/{version}', 'ReleaseController@editRelease')->name('editrelease');
                Route::post('/update/{version}', 'ReleaseController@updateRelease')->name('updaterelease');
                Route::get('/{version}/pdf', 'PDFController@createPDF')->name('createpdf');


                Route::group(['prefix' => 'feature'], function () {
                    Route::get('/add', 'FeatureController@add')->name('addfeature');
                    Route::get('/{feature_id}', 'FeatureController@showFeature')->name('showfeature');
                    Route::get('/{feature_id}/edit', 'FeatureController@editFeature')->name('editFeature');
                    Route::post('/{feature_id}/edit', 'FeatureController@updateFeature')->name('updateFeature');

                    Route::post('/store', 'FeatureController@store')->name('storefeature');
                });

                });


            Route::group(['prefix' => 'release'], function (){
                Route::get('/add', 'ReleaseController@addRelease')->name('addrelease');
                Route::post('/add', 'ReleaseController@storeRelease')->name('storerelease');
            });
        });
    });
});