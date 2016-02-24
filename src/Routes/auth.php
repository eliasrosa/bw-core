<?php

// Login routes ...
Route::post('login', 'BW\Controllers\Auth\AuthController@postLogin');
Route::get('login', 'BW\Controllers\Auth\AuthController@getLogin');

// Logout routes ...
Route::get('logout', 'BW\Controllers\Auth\AuthController@getLogout');

// Remember routes ...
Route::get('remember', 'BW\Controllers\Auth\RememberController@getRemember');
Route::post('remember', 'BW\Controllers\Auth\RememberController@postRemember');

// Reset password routes ...
Route::post('password/reset', 'BW\Controllers\Auth\ResetPasswordController@postReset');
Route::get('password/reset/{token?}', 'BW\Controllers\Auth\ResetPasswordController@getReset');



