<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::auth();

Route::group(['namespace' => 'Auth'], function () {
    Route::get('is_login', 'AuthController@is_login');
    Route::get('auth/facebook', 'AuthController@redirectToProvider');
    Route::get('auth/facebook/callback', 'AuthController@handleProviderCallback');
});

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {
    Route::get('test', 'TestController@test');
    Route::get('campaign/purposes', 'CampaignController@purposes');
    Route::post('campaign/launch', 'CampaignController@launch');
    Route::post('amazon/get_token', 'AmazonController@get_token');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/launch', 'HomeController@launch');
Route::get('/{any}', 'HomeController@index')->where('any', '.*');
