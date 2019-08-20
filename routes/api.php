<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::apiResource('user', 'API\UserController');

//UserController functions
Route::group(['prefix'=> 'user'], function($router) {

    Route::get('/', 'UserController@index');
    Route::get('/profile', 'UserController@profile');

    Route::post('/', 'UserController@store');
    Route::post('/login', 'UserController@login');
    Route::post('/registerDiamond', 'UserController@registerDiamond');
    Route::post('/registerBronze', 'UserController@registerBronze');

    Route::put('/{any}', 'UserController@update');

    Route::delete('/{any}', 'UserController@destroy');

});

//QueueController functions
Route::group(['prefix'=> 'queue'], function($router) {

    Route::get('/', 'QueueController@index');
    Route::get('/getTotal', 'QueueController@getTotal');
    Route::get('/getBracket', 'QueueController@getBracket');
    Route::get('/configNumber', 'QueueController@configNumber');

    Route::post('/', 'QueueController@store');

});

//KeyController functions
Route::group(['prefix'=> 'key'], function($router) {

    Route::get('/checkKey', 'KeyController@checkKey');
    Route::get('/getAllKeys', 'KeyController@getAllKeys');
    Route::get('/getMyKeys', 'KeyController@getMyKeys');
    Route::get('/myAccounts', 'KeyController@myAccounts');
    
    Route::post('/', 'KeyController@store');

    Route::put('/update/{any}', 'KeyController@update');

    Route::delete('/deletekey/{any}', 'KeyController@destroy');
    
});

//BracketController functions
Route::group(['prefix'=> 'bracket'], function($router) {

    Route::get('/getActiveBracket', 'BracketController@getActiveBracket');

    Route::post('/', 'BracketController@store');

});

//WalletController
Route::group(['prefix'=> 'wallet'], function($router) {

    Route::post('/', 'WalletController@store');
    Route::post('/referralActivated', 'WalletController@referralActivated');

    Route::get('/getEarnings', 'WalletController@getEarnings');

});

//ProofController
Route::group(['prefix'=> 'proof'], function($router) {

    Route::get('/getRequests', 'ProofController@getRequests');
    Route::get('/getMyRequests', 'ProofController@getMyRequests');
    
    Route::post('/approveRequest', 'ProofController@approveRequest');
    Route::post('/disapproveRequest', 'ProofController@disapproveRequest');
    Route::post('/', 'ProofController@store');

    Route::put('/cancelRequest', 'ProofController@cancelRequest');

});

//NotifController
Route::group(['prefix'=> 'notification'], function($router) {
    
    Route::post('/KeyDisapproved', 'NotifController@KeyDisapproved');
    Route::post('/KeyRequest', 'NotifController@KeyRequest');
    Route::post('/requestEncash', 'NotifController@requestEncash');
    Route::post('/encashmentApproved', 'NotifController@encashmentApproved');

    Route::get('/', 'NotifController@index');
    Route::get('/getUnreadNotifs', 'NotifController@getUnreadNotifs');
    Route::get('/getEncashmentRequests', 'NotifController@getEncashmentRequests');

    Route::put('/read', 'NotifController@read');

});



// Route::get('bronze/test', 'Bronze\GenealogyController@test');
// ===== Bronze Package APIs =====
// POST API for creating new genealogy object
// Needs 4 parameters user_id, reference_id, referal_id, and position
// Returns the new genealogy and match point object
Route::post('bronze/genealogy/create', 'Bronze\BronzeController@create_genealogy');
// GET API for viewing current user's genealogy, can accept a user_id as parameter to view specific genealogy
Route::get('bronze/genealogy', 'Bronze\BronzeController@genealogy');
// GET API for viewing current user's dashboard
Route::get('bronze/dashboard', 'Bronze\BronzeController@dashboard');
// GET API for viewing current user's wallet
Route::get('bronze/wallet', 'Bronze\BronzeController@wallet');
// GET API for viewing current user's points
Route::get('bronze/points', 'Bronze\BronzeController@points');
// POST API for calculating product points of user
// Needs 4 parameters user_id, product_id and quantity
// Returns a user product log object
Route::post('bronze/product-purchase', 'Bronze\BronzeController@product_purchase');
