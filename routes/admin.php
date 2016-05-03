<?php

//
Route::get('/', [
    'as' => 'bw.home',
    'uses' => 'BW\Controllers\DashboardController@dashboard',
]);

Route::resource('users/groups', 'BW\Controllers\UsersGroupsController');
Route::resource('users', 'BW\Controllers\UsersController');
