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

//Route::get('/', 'WelcomeController@index');
Route::get('/', 'HomeController@index');

Route::get('/dashboard', 'Main@view_dashboard');
Route::get('/add/user', 'Main@add_user');
Route::get('/users', 'Main@view_users');
Route::get('/edit/user/{id}', 'Main@edit_user');
Route::get('/logout', 'Main@logout');

Route::post('/login', 'HomeController@authenticate');//for login authentication
Route::post('/insert/user', 'Main@insert_user');
Route::post('/update/user/{id}', 'Main@update_user');



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
