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
Route::bind('campaign_slug', function ($value) {
    return App\Campaign::where('slug', $value)->first();
});
Route::bind('campaign_id', function ($value) {
    return App\Campaign::where('id', $value)->firstOrFail();
});

Route::group(['namespace' => 'Auth'], function () {
    Route::get('auth/facebook', 'AuthController@redirectToProvider');
    Route::get('auth/facebook/callback', 'AuthController@handleProviderCallback');
});

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {
    Route::get('test', 'TestController@test');
    Route::get('is_login', 'ProfileController@is_login');
    Route::get('campaign/purposes', 'CampaignController@purposes');
    Route::get('campaign/get_by_id/{campaign_id}', 'CampaignController@get');
    Route::get('campaign/get_by_slug/{campaign_slug}', 'CampaignController@get');
    Route::post('amazon/get_token', 'AmazonController@get_token');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('campaign/dashboard', 'CampaignController@dashboard');
        Route::post('campaign/launch', 'CampaignController@launch');
        Route::post('buy/{campaign_id}', 'OrderController@buy');
        Route::post('profile', 'ProfileController@updateProfile');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/launch', 'HomeController@launch');
Route::get('/launch/{campaign_id}', 'HomeController@launch');
Route::get('/{any}', 'HomeController@index')->where('any', '.*');
