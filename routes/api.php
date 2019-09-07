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

Route::post('register','API\UserController@register');
Route::post('login','API\UserController@login');

Route::group(['middleware'=>'auth:api'],function()
{
    Route::post('details','API\UserController@details');
});

Route::get('blog/index','API\BlogApiController@index');
Route::get('blog/category/{category}','API\BlogApiController@category');
Route::get('blog/search/{blog}','API\BlogApiController@searchBlog');
Route::post('blog/add','API\BlogApiController@insertData');
Route::get('blog/{id}','API\BlogApiController@blogId');
Route::post('blog/update','API\BlogApiController@updates');
Route::get('blog/detail/{id}','API\BlogApiController@detailBlog');
Route::post('user/login','UserController@login');
Route::post('user/register','UserController@register');
Route::get('user/detail','UserController@getAuthenticatedUser');