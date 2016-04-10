<?php

// Login routes ...
Route::post('login', 'BW\Admin\Controllers\Auth\LoginController@postLogin');

//
Route::get('login', [
    'as' => 'bw.login.index',
    'uses' => 'BW\Admin\Controllers\Auth\LoginController@getLogin'
]);

// Logout routes ...
Route::get('logout', [
    'as' => 'bw.logout',
    'uses' => 'BW\Admin\Controllers\Auth\LoginController@getLogout'
]);

// Remember routes ...
Route::post('login/remember', 'BW\Admin\Controllers\Auth\RememberController@postRemember');

//
Route::get('login/remember', [
    'as' => 'bw.login.remember',
    'uses' => 'BW\Admin\Controllers\Auth\RememberController@getRemember'
]);

// Reset password routes ...
Route::post('login/password/reset', 'BW\Admin\Controllers\Auth\ResetPasswordController@postReset');

//
Route::get('login/password/reset/{token?}', [
    'as' => 'bw.login.reset',
    'uses' => 'BW\Admin\Controllers\Auth\ResetPasswordController@getReset'
]);
