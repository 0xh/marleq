<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => '/manage', 'middleware' => 'role:superadministrator|administrator'], function () {
    Route::get('/', ['as' => 'manage', 'uses' => 'ManageController@index']);
    Route::get('/dashboard', ['as' => 'manage.dashboard', 'uses' => 'ManageController@dashboard']);
    Route::resource('/users', 'UserController');
    Route::resource('/roles', 'RoleController', ['except' => 'destroy']);
    Route::resource('/permissions', 'PermissionController', ['except' => 'destroy']);
});
Route::get('/home', 'HomeController@index')->name('home');