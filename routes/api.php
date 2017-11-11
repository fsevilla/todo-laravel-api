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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/user/permissions', 'v1\PermissionsController@getUserPermissions')->middleware('auth:api');


/*
|--------------------------------------------------------------------------
| USERS Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix' => 'users',
    // 'middleware' => ['auth:api']
], function () {
    Route::get('', 'v1\UsersController@index');
    Route::get('{id}', 'v1\UsersController@show')->middleware('can:read,users');
    Route::post('', 'v1\UsersController@create');
    Route::put('{id}', 'v1\UsersController@update')->middleware('can:write,users');
    Route::delete('{id}', 'v1\UsersController@delete')->middleware('can:write,users');
});

/*
|--------------------------------------------------------------------------
| RESOURCES Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix' => 'resources',
    'middleware' => 'auth:api'
], function () {
    Route::get('', 'v1\ResourcesController@index');
    Route::get('{id}', 'v1\ResourcesController@show');
});

/*
|--------------------------------------------------------------------------
| PERMISSIONS Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix' => 'permissions',
    'middleware' => 'auth:api'
], function () {
    Route::get('', 'v1\PermissionsController@index');
    Route::get('{id}', 'v1\PermissionsController@show');
});

/*
|--------------------------------------------------------------------------
| FAQs Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix' => 'faqs'
], function () {
    Route::get('', 'v1\FaqsController@index');
    Route::get('{id}', 'v1\FaqsController@show');
});

Route::group([
    'prefix' => 'faqs',
    'middleware' => ['auth:api', 'can:write,faqs']
], function () {
    Route::post('', 'v1\FaqsController@create');
    Route::put('{id}', 'v1\FaqsController@update');
    Route::delete('{id}', 'v1\FaqsController@delete');
    Route::put('{id}/move', 'v1\FaqsController@reorganize');
});

/*
|--------------------------------------------------------------------------
| Status Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix' => 'status'
], function () {
    Route::get('', 'v1\StatusController@index');
    Route::get('{id}', 'v1\StatusController@show');
});

/*
|--------------------------------------------------------------------------
| ToDo's Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'prefix' => 'todos',
    'middleware' => ['auth:api', 'can:read,todos']
], function () {
    Route::get('', 'v1\TodosController@index');
    Route::get('{id}', 'v1\TodosController@show');
});

Route::group([
    'prefix' => 'todos',
    // 'middleware' => ['auth:api', 'can:write,todos']
], function () {
    Route::post('', 'v1\TodosController@create');
    Route::put('{id}', 'v1\TodosController@update');
    Route::delete('{id}', 'v1\TodosController@delete');
    Route::put('{id}/move', 'v1\TodosController@reorganize');
});



Route::get('secret_key', function(){
    echo 'EaNWQo6E4VgK2DqN8IMOeCapnzU2VOEhyI4McdGx';
});