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

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/about-us', ['as' => 'about-us', 'uses' => 'HomeController@aboutUs']);
Route::get('/inspiration', ['as' => 'inspiration', 'uses' => 'HomeController@inspirationIndex']);
Route::get('/inspiration/{alias}', ['as' => 'inspiration-show', 'uses' => 'HomeController@inspirationShow']);
Route::get('/events', ['as' => 'events', 'uses' => 'HomeController@eventsIndex']);
Route::get('/events/{alias}', ['as' => 'event-show', 'uses' => 'HomeController@eventShow']);
Route::get('/services', ['as' => 'services', 'uses' => 'HomeController@servicesIndex']);
Route::get('/services/{alias}', ['as' => 'service-show', 'uses' => 'HomeController@serviceShow']);

Auth::routes();

Route::group(['prefix' => '/manage', 'middleware' => 'role:superadministrator|administrator'], function () {
    Route::get('/', ['as' => 'manage', 'uses' => 'ManageController@index']);
    Route::get('/dashboard', ['as' => 'manage.dashboard', 'uses' => 'ManageController@dashboard']);

    Route::resource('/services', 'ServiceController');
    Route::resource('/costs', 'CostController');

    Route::resource('/posts', 'PostController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/tags', 'TagController');

    Route::resource('/users', 'UserController');
    Route::resource('/specialties', 'SpecialtyController');
    Route::resource('/countries', 'CountryController');
    Route::resource('/testimonials', 'TestimonialController');
    Route::resource('/levels', 'LevelController', ['except' => 'destroy']);
    Route::resource('/roles', 'RoleController', ['except' => 'destroy']);
    Route::resource('/permissions', 'PermissionController', ['except' => 'destroy']);
});