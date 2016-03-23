<?php

$prefix = config('bw.admin.url');

// Login routes ...
Route::post($prefix . '/login', 'BW\Controllers\Auth\AuthController@postLogin');
Route::get($prefix . '/login', 'BW\Controllers\Auth\AuthController@getLogin');

// Logout routes ...
Route::get($prefix . '/logout', 'BW\Controllers\Auth\AuthController@getLogout');

// Remember routes ...
Route::get($prefix . '/remember', 'BW\Controllers\Auth\RememberController@getRemember');
Route::post($prefix . '/remember', 'BW\Controllers\Auth\RememberController@postRemember');

// Reset password routes ...
Route::post($prefix . '/password/reset', 'BW\Controllers\Auth\ResetPasswordController@postReset');
Route::get($prefix . '/password/reset/{token?}', 'BW\Controllers\Auth\ResetPasswordController@getReset');
