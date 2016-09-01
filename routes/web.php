<?php

/********************************************
 *                 admin
 ********************************************/
Route::group(['prefix' => 'admin'], function () {
    Route::resource('user', 'Admin\UserController');
});
