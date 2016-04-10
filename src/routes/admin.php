<?php

//
Route::get('/', [
    'as' => 'bw.home',
    'uses' => 'BW\Admin\Controllers\DashboardController@dashboard'
]);
