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

Route::post('/roles', 'RolesController@create');
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

//DiamondQueuesController functions
Route::group(['prefix'=> 'queue'], function($router) {
    Route::get('/', 'Diamond\DiamondQueuesController@index');
    Route::get('/getTotal', 'Diamond\DiamondQueuesController@getTotal');
    Route::get('/getBracket', 'Diamond\DiamondQueuesController@getBracket');
    Route::get('/configNumber', 'Diamond\DiamondQueuesController@configNumber');

    Route::post('/', 'Diamond\DiamondQueuesController@store');

});

//KeysController functions
Route::group(['prefix'=> 'key'], function($router) {

    Route::get('/checkKey', 'KeysController@checkKey');
    Route::get('/getAllKeys', 'KeysController@getAllKeys');
    Route::get('/getMyKeys', 'KeysController@getMyKeys');
    Route::get('/myAccounts', 'KeysController@myAccounts');
    
    Route::post('/', 'KeysController@store');

    Route::put('/update/{any}', 'KeysController@update');

    Route::delete('/deletekey/{any}', 'KeysController@destroy');
    
});

//CurrentQueueController functions
Route::group(['prefix'=> 'bracket'], function($router) {

    Route::get('/getActiveBracket', 'Diamond\CurrentQueueController@getActiveBracket');

    Route::post('/', 'Diamond\CurrentQueueController@store');

});

//WalletsController
Route::group(['prefix'=> 'wallet'], function($router) {

    Route::post('/', 'WalletsController@store');
    Route::post('/referralActivated', 'WalletsController@referralActivated');

    Route::get('/getEarnings', 'WalletsController@getEarnings');

});

//RequestsController
Route::group(['prefix'=> 'proof'], function($router) {

    Route::get('/getRequests', 'RequestsController@getRequests');
    Route::get('/getMyRequests', 'RequestsController@getMyRequests');
    
    Route::post('/approveRequest', 'RequestsController@approveRequest');
    Route::post('/disapproveRequest', 'RequestsController@disapproveRequest');
    Route::post('/', 'RequestsController@store');

    Route::put('/cancelRequest', 'RequestsController@cancelRequest');

});

//NotificationsController
Route::group(['prefix'=> 'notification'], function($router) {
    
    Route::post('/KeyDisapproved', 'NotificationsController@KeyDisapproved');
    Route::post('/KeyRequest', 'NotificationsController@KeyRequest');
    Route::post('/requestEncash', 'NotificationsController@requestEncash');
    Route::post('/encashmentApproved', 'NotificationsController@encashmentApproved');

    Route::get('/', 'NotificationsController@index');
    Route::get('/getUnreadNotifs', 'NotificationsController@getUnreadNotifs');
    Route::get('/getEncashmentRequests', 'NotificationsController@getEncashmentRequests');

    Route::put('/read', 'NotificationsController@read');

});



// Route::get('bronze/test', 'Bronze\GenealogyController@test');
// ===== Bronze Package APIs =====
// POST API for creating new genealogy object
// Needs 4 parameters user_id, reference_id, referal_id, and position
// Returns the new genealogy and match point object
Route::post('bronze/genealogy/create', 'Bronze\BronzeController@create_genealogy');
// GET API for viewing current user's genealogy information, can accept a user_id as parameter to view specific genealogy
Route::get('bronze/genealogy/information', 'Bronze\BronzeController@geanalogy_information');
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
