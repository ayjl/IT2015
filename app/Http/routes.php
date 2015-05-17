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

Route::get('/', ['uses'=>'ProductController@index', 'as'=>'home']);
Route::resource('product', 'ProductController', ['only'=>'show']);


Route::get('auth/login', ['uses'=>'Auth\AuthController@getLogin', 'as'=>'auth.login']);
Route::post('auth/login', ['uses'=>'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['uses'=>'Auth\AuthController@getLogout', 'as'=>'auth.logout']);

Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function()
{
    Route::get('/', ['as'=>'admin.home', function()
    {
        return Redirect::route('admin.product.index');
    }]);

    Route::resource('product', 'ProductController', ['except'=>'show']);
});

Route::group(['prefix'=>'fbgraphapi'], function()
{
	Route::get('fb_events', ['as' => 'fb_events', 'uses' => 'FBController@eventslist']);
	Route::get('fb_events_retrieve', ['as' => 'fb_events_retrieve', 'uses' => 'FBController@eventsretrieve']);
	Route::get('fb_rsvp', ['as' => 'fb_rsvp', 'uses' => 'FBController@rsvplist']);
	Route::get('fb_rsvp_retrieve', ['as' => 'fb_rsvp_retrieve', 'uses' => 'FBController@rsvpretrieve']);
	
	
	Route::resource('fb_user_retrieve', 'FBController@userretrieve' , ['as' => 'fb_user_retrieve']);
	
	Route::resource('profile', 'FBController', ['only'=>'show']);
});