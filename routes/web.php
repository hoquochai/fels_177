<?php

/********************************************
 *                 admin
 ********************************************/
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('home',['as'=> 'homeAdmin','uses' => 'Admin\AdminController@index']);
    Route::get('logout',['as'=> 'logoutAdmin','uses' => 'LoginController@logout']);
    Route::get('profile',['as'=> 'profileAdmin','uses' => 'Admin\AdminController@profile']);
    Route::post('profile',['as'=> 'updateProfile','uses' => 'Admin\AdminController@update']);
    Route::post('changePassword',['as'=> 'changePassword','uses' => 'Admin\AdminController@changePassword']);
    Route::resource('user', 'Admin\UserController');
    Route::resource('category', 'Admin\CategoryController');
    Route::resource('word', 'Admin\WordController');
    Route::resource('word_answer', 'Admin\WordAnswerController');
});

/********************************************
 *                 user
 ********************************************/
Route::group(['middleware' => 'user'], function () {

});

/********************************************
 *                 login - logout
 ********************************************/
Route::get('/',['as'=> 'getLogin','uses' => 'LoginController@index']);
Route::post('login',['as'=> 'postLogin','uses' => 'LoginController@login']);
Route::post('logout',['as'=> 'logout','uses' => 'LoginController@logout']);
