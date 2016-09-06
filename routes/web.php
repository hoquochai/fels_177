<?php

/********************************************
 *                 admin
 ********************************************/
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index');
    Route::get('logout', 'AdminController@logout');
    Route::get('profile', 'AdminController@profile');
    Route::resource('user', 'Admin\UserController');
    Route::resource('category', 'Admin\CategoryController');
    Route::resource('word', 'Admin\WordController');
    Route::resource('word_answer', 'Admin\WordAnswerController');
});
