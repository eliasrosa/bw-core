<?php

//
Route::get('/', ['as' => 'home', 'uses' => 'BW\Controllers\AdminController@dashboard']);

Route::get('/teste', function(){
    return 'teste';
});
