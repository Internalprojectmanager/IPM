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
    return redirect()->route('dashboard');
});

Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::get('/help', 'HomeController@help')->name('help');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard')->middleware('auth');
Route::post('/dashboard', 'HomeController@dashboardSearch')->name('dashboardsearch')->middleware('auth');
Route::post('/dashboard/save', 'RequirementController@saveAuthStatus')->name('requirementsaveAuthstatus');


Route::group(['middleware' => ['guest', 'web']], function () {
    Auth::routes();
    Route::get('auth/google', 'Auth\LoginController@redirectToProvider')->name('googlelogin');
    Route::get('auth/google/callback', 'Auth\LoginController@handleProviderCallback')->name('googleauth');
});

//Profile routes
Route::get('/profile', 'ProfileController@viewProfile')->name('profile');
Route::post('/profile', 'ProfileController@updateProfile')->name('saveprofile');

Route::group(['prefix' => 'team'], function() {
    Route::get('/show/{team}', 'TeamController@show')->name('team.show');
    Route::get('/add', 'TeamController@new')->name('team.new');
    Route::post('/add/', 'TeamController@store')->name('team.store');
    Route::post('/{team}/member/new', 'TeamController@storeMember')->name('teammember.store');
    Route::get('/{team}/member/{member}/delete', 'TeamController@deleteMember')->name('teammember.delete');
    Route::get('/{team}/member/{member}/block', 'TeamController@changeblockingMember')->name('teammember.block');
    Route::get('/{team}/member/{member}/unblock', 'TeamController@changeblockingMember')->name('teammember.unblock');
});


//Auth Routes
Route::group(['prefix' => 'password'], function () {
    Route::get('/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/request', 'Auth\ResetPasswordController@reset');
    Route::get('/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
});

//Client Routes
Route::group(['prefix' => 'client'], function () {
    Route::get('/overview', 'ClientController@overviewClient')->name('overviewclient');
    Route::post('/overview', 'ClientController@searchClient')->name('searchClient');;
    Route::get('/add', 'ClientController@addClient')->name('addclient');
    Route::post('/add', 'ClientController@storeClient')->name('storeclient');
    Route::post('{client}/edit', 'ClientController@updateClient')->name('updateclients');
    Route::get('/{client}/delete', 'ClientController@deleteClient')->name('deleteclient');
    Route::get('/{client}/details', 'ClientController@detailsClient')->name('clientdetails');
    Route::post('/{client}/details', 'ClientController@detailsSort')->name('clientsorting');
});

Route::post('/release/overview', 'ReleaseController@overviewTestrapport')->name('storerelease');
Route::post('/file/delete/{document_id}', 'DocumentController@deleteFile')->name('deletefile');

Route::group(['prefix' => 'project'], function () {
    //Project Routes
    Route::get('/overview', 'ProjectController@overviewProject')->name('overviewproject');
    Route::post('/overview', 'ProjectController@searchProject')->name('searchproject');
    Route::get('/add', 'ProjectController@addProject')->name('addproject');
    Route::post('/add', 'ProjectController@storeProject')->name('storeproject');
});
Route::prefix('{client}')->group( function (){
    Route::group(['prefix' => '{project}'], function () {
        Route::get('/details', 'ProjectController@detailsProject')->name('projectdetails');
        Route::get('/edit', 'ProjectController@editProject')->name('editproject');
        Route::post('/edit', 'ProjectController@updateProject')->name('updateproject');
        Route::get('/delete', 'ProjectController@deleteProject')->name('deleteproject');
        Route::post('/assigneeupdate', 'ProjectController@updateAssignees')->name('assigneeupdate');

        //Document Routes
        Route::group(['prefix' => 'documents'], function () {
            Route::get('/', 'DocumentController@overviewDocuments')->name('documentoverview');
            Route::get('/add', 'DocumentController@addDocument')->name('adddocument');
            Route::put('/add', 'DocumentController@storeDocument')->name('storedocument');
            Route::get('/show/{document}', 'DocumentController@showDocument')->name('showdocument');
            Route::get('/edit/{document}', 'DocumentController@editDocument')->name('editdocument');
            Route::put('/edit/{document}', 'DocumentController@updateDocument')->name('updatedocument');
            Route::get('/delete/{document}', 'DocumentController@deleteDocument')->name('deletedocument');
            Route::get('/download/{document}', 'DocumentController@downloadFile')->name('downloadfile');

        });

        //Release Routes
        Route::group(['prefix' => '{release}'], function () {
            Route::get('/{version}/details', 'ReleaseController@showRelease')->name('showrelease');
            Route::get('/edit/{version}', 'ReleaseController@editRelease')->name('editrelease');
            Route::get('/delete/{version}', 'ReleaseController@deleteRelease')->name('deleterelease');
            Route::post('/update/{version}', 'ReleaseController@updateRelease')->name('updaterelease');
            Route::get('/{version}/pdf', 'PDFController@createPDF')->name('createpdf');

            //Feature Routes
            Route::group(['prefix' => 'feature'], function () {
                Route::get('/add', 'FeatureController@add')->name('addfeature');
                Route::get('/{feature}', 'FeatureController@showFeature')->name('showfeature');
                Route::post('/store', 'FeatureController@store')->name('storefeature');
                Route::post('/{feature}', 'RequirementController@saveStatus')->name('requirementsavestatus');
                Route::get('/{feature}/edit', 'FeatureController@editFeature')->name('editFeature');
                Route::post('/{feature}/edit', 'FeatureController@updateFeature')->name('updateFeature');
                Route::get('/{feature}/delete', 'FeatureController@deleteFeature')->name('deletefeature');
            });
        });

        //Release Adding routes
        Route::group(['prefix' => 'release'], function () {
            Route::get('/add', 'ReleaseController@addRelease')->name('addrelease');
            Route::post('/add', 'ReleaseController@storeRelease')->name('storerelease');
        });
    });
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
