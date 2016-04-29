<?php

// Login routes ...
Route::post('login', 'BW\Controllers\Auth\LoginController@postLogin');

//
Route::get('login', [
    'as' => 'bw.login.index',
    'uses' => 'BW\Controllers\Auth\LoginController@getLogin'
]);

// Logout routes ...
Route::get('logout', [
    'as' => 'bw.logout',
    'uses' => 'BW\Controllers\Auth\LoginController@getLogout'
]);

// Remember routes ...
Route::post('login/remember', 'BW\Controllers\Auth\RememberController@postRemember');

//
Route::get('login/remember', [
    'as' => 'bw.login.remember',
    'uses' => 'BW\Controllers\Auth\RememberController@getRemember'
]);

// Reset password routes ...
Route::post('login/password/reset', 'BW\Controllers\Auth\ResetPasswordController@postReset');

//
Route::get('login/password/reset/{token?}', [
    'as' => 'bw.login.reset',
    'uses' => 'BW\Controllers\Auth\ResetPasswordController@getReset'
]);
