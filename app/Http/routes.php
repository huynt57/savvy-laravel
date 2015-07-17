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

Route::get('/', 'StudentController@index');

Route::get('home', 'HomeController@index');

Route::get('contact', 'WelcomeController@contact');

Route::get('student', 'StudentController@index');

Route::get('student/addstudent', 'StudentController@addstudent');

Route::post('student/edit', 'StudentController@edit');

Route::post('student/paginate', 'StudentController@paginate');

Route::post('student/search', 'StudentController@search');

Route::get('student/delete_edit', 'StudentController@editstudent');

Route::post('student/addstudent', 'StudentController@addstudent');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
