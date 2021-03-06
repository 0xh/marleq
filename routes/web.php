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
Route::get('/find-a-coach', ['as' => 'find-a-coach', 'uses' => 'HomeController@findACoach']);
Route::get('/coaches/{alias}', ['as' => 'coach-show', 'uses' => 'HomeController@coachShow']);
Route::get('/free-cv', ['as' => 'free-cv.index', 'uses' => 'HomeController@freeCV']);
Route::post('/free-cv', ['as' => 'free-cv.store', 'uses' => 'HomeController@freeCVStore']);

Route::group(['prefix' => '/messages', 'middleware' => 'role:superadministrator|administrator|country-manager|coach|user'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessageController@inbox']);
    Route::get('/chat/{userId}', ['as' => 'chat', 'uses' => 'MessageController@index']);
    Route::post('/send', 'MessageController@send');
    Route::post('/read', 'MessageController@messageRead');
});

Route::group(['prefix' => '/user', 'middleware' => 'role:country-manager|coach|user'], function () {
    Route::get('/', ['as' => 'user', 'uses' => 'ProfileController@index']);
    Route::resource('/profile', 'ProfileController')->only(['index', 'edit', 'update']);
    Route::get('/testimonials', ['as' => 'testimonial.index', 'uses' => 'ProfileController@testimonials']);
    Route::post('/testimonials', ['as' => 'testimonial.store', 'uses' => 'ProfileController@testimonialStore']);
    Route::get('/cv-requests', ['as' => 'cv-requests.index', 'uses' => 'ProfileController@freeCVRequests']);
    Route::get('/cv-requests/{id}/edit', ['as' => 'cv-requests.edit', 'uses' => 'ProfileController@freeCVEdit']);
    Route::put('/cv-requests/{id}', ['as' => 'cv-requests.update', 'uses' => 'ProfileController@freeCVUpdate']);
    Route::get('/card', ['as' => 'card.index', 'uses' => 'ProfileController@createBusinessCard']);
    Route::post('/card', ['as' => 'card.store', 'uses' => 'ProfileController@storeBusinessCard']);
});

Auth::routes();

// Registration Routes for Job Seekers and Country Managers
$this->get('register-coach', 'Auth\RegisterController@showCoachRegistrationForm')->name('register-coach');
$this->post('register-coach', 'Auth\RegisterController@register');
$this->get('register-country-manager', 'Auth\RegisterController@showCountryManagerRegistrationForm')->name('register-country-manager');
$this->post('register-country-manager', 'Auth\RegisterController@register');

Route::group(['prefix' => '/manage', 'middleware' => 'role:superadministrator'], function () {
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
    Route::resource('/languages', 'LanguageController');
    Route::resource('/testimonials', 'TestimonialController');
    Route::resource('/levels', 'LevelController', ['except' => 'destroy']);
    Route::resource('/roles', 'RoleController', ['except' => 'destroy']);
    Route::resource('/permissions', 'PermissionController', ['except' => 'destroy']);

    Route::resource('/surveys', 'SurveyController');
    Route::resource('/questions', 'QuestionController');
    Route::resource('/answers', 'AnswerController');
    Route::resource('/results', 'ResultController');

    Route::resource('/tip-types', 'TipTypeController');
    Route::resource('/tips', 'TipController');
    Route::resource('/resumes', 'ResumeController');

});