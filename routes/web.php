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
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'password'], function () {
    Route::get('/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/reset', 'Auth\ResetPasswordController@reset');
    Route::get('/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
});

Route::group(['prefix' => 'client'], function (){
    Route::get('/overview', 'CompanyController@overviewCompany')->name('overviewclient');
    Route::get('/{name}/details', 'CompanyController@detailsCompany')->name('clientdetails');
    Route::get('/add', 'CompanyController@addCompany')->name('addclient');
    Route::post('/add', 'CompanyController@storeCompany')->name('storeclient');
    Route::get('/edit/{name}', 'CompanyController@editCompany')->name('editclient');
    Route::post('/edit/{name}', 'CompanyController@updateCompany')->name('updateclient');
    Route::get('/delete/{name}', 'CompanyController@deleteCompany')->name('deleteclient');
});
Route::group(['prefix' => 'project'], function () {
    Route::get('/overview', 'ProjectController@overviewProject')->name('overviewproject');
    Route::get('/add', 'ProjectController@addProject')->name('addproject');
    Route::post('/add', 'ProjectController@storeProject')->name('storeproject');
});
Route::group(['prefix' => 'document'], function (){
   Route::get('/add/{name}/{client_id}', 'DocumentController@addDocument')->name('adddocument');
   Route::post('/add', 'DocumentController@storeDocument')->name('storedocument');
   Route::get('/delete/{id}', 'DocumentController@deleteDocument')->name('deletedocument');
});

Route::group(['prefix' => 'letter'], function (){
    Route::get('/add/{name}/{client_id}', 'LetterController@addLetter')->name('addletter');
    Route::post('/add', 'LetterController@storeLetter')->name('storeletter');
    Route::get('/delete/{id}', 'LetterController@deleteLetter')->name('deleteletter');
});

// TEST REPORT OVERVIEW
Route::group(['prefix' => 'testreport'], function () {
    Route::get('/{id}/add', 'TestReportController@addTestReport')->name('addtestreport');
    Route::post('/store', 'TestreportController@storeTestreport')->name('storetestreport');
    Route::get('/{id}/details', 'TestReportController@detailsTestReport')->name('detailstestreport');
    Route::get('/{id}/delete', 'TestReportController@deleteTestReport')->name('deletetestreport');
    Route::get('/{id}/edit', 'TestReportController@editTestReport')->name('edittestreport');
    Route::post('/{id}/update', 'TestReportController@updateTestReport')->name('updatetestreport');
});

Route::post('/release/overview', 'ReleaseController@overviewTestrapport')->name('storerelease');

Route::group(['prefix' => '{client_id}'], function () {
    Route::group(['prefix' => 'project'], function (){
        Route::group(['prefix' => '{name}'], function (){
            Route::get('/details', 'ProjectController@detailsProject')->name('projectdetails');
            Route::get('/edit', 'ProjectController@editProject')->name('editproject');
            Route::post('/edit', 'ProjectController@updateProject')->name('updateproject');
            Route::get('/delete', 'ProjectController@deleteProject')->name('deleteproject');

            Route::get('/document/{document_id}', 'DocumentController@showDocument')->name('showdocument');
            Route::get('/edit/{document_id}', 'DocumentController@editDocument')->name('editdocument');
            Route::post('/edit/{document_id}', 'DocumentController@updateDocument')->name('updatedocument');

            Route::get('/letter/{letter_id}', 'LetterController@showLetter')->name('showletter');
            Route::get('/{letter_id}/edit', 'LetterController@editLetter')->name('editletter');
            Route::post('/{letter_id}/edit', 'LetterController@updateLetter')->name('updateletter');

            Route::group(['prefix' => '{release_name}'], function (){
                Route::get('/{version}/details', 'ReleaseController@showRelease')->name('showrelease');
                Route::get('/feature', 'FeatureController@add')->name('addfeature');
                Route::get('/feature/{feature_id}/edit', 'FeatureController@editFeature')->name('editFeature');
                Route::post('/feature/{feature_id}/edit', 'FeatureController@updateFeature')->name('updateFeature');

                Route::post('/feature/store', 'FeatureController@store')->name('storefeature');
            });

            Route::group(['prefix' => 'release'], function (){
                Route::get('/add', 'ReleaseController@addRelease')->name('addrelease');
                Route::post('/add', 'ReleaseController@storeRelease')->name('storerelease');
            });
        });
    });
});