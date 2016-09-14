<?php

/********************************************
 *                 admin
 ********************************************/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function () {
    Route::get('home', ['as'=> 'home', 'uses' => 'AdminController@index']);
    Route::get('profile', ['as'=> 'profile', 'uses' => 'AdminController@profile']);
    Route::post('profile', ['as'=> 'updateProfile', 'uses' => 'AdminController@update']);
    Route::post('changePassword',['as'=> 'changePassword', 'uses' => 'AdminController@changePassword']);
    Route::resource('user', 'UserController');
    Route::resource('category', 'CategoryController');
    Route::resource('word', 'WordController');
    Route::resource('word_answer', 'WordAnswerController');
});

/********************************************
 *                 user
 ********************************************/
Route::group(['namespace' => 'User', 'middleware' => 'user'], function () {
    Route::resource('category', 'CategoryController');
    Route::resource('lesson', 'LessonController');
    Route::resource('word', 'WordController');
    Route::resource('export-pdf', 'ExportPdfController');
    Route::resource('profile', 'ProfileController');
    Route::resource('home', 'HomeController');
    Route::resource('result', 'ResultController');
    Route::resource('change-password', 'ChangePasswordController');
    Route::resource('follow', 'FollowController');
    Route::resource('un-follow', 'UnFollowController');
});

/********************************************
 *                 login - logout
 ********************************************/
Route::get('/', ['as'=> 'getLogin', 'uses' => 'LoginController@index']);
Route::post('login', ['as'=> 'postLogin', 'uses' => 'LoginController@login']);
Route::get('logout', ['as'=> 'logout', 'uses' => 'LoginController@logout']);
