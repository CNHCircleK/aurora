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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'auth'], function() {
	Route::resource('awards', 'AwardController');
	Route::resource('invites', 'InviteController');
	Route::resource('submissions', 'SubmissionController');
	Route::resource(strtolower(trans_choice('team.teams', 2)), 'TeamController');
	Route::resource('users', 'UserController', ['except' => ['create', 'store']]);
});
