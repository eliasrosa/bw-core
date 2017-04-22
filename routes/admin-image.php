<?php
//
// Image
//
Route::get('image', [
    'uses' => 'BW\Util\Relationships\Image\ImageApiController@getImage',
    'as' => 'bw.relationships.image.get',
]);

Route::get('image/remove', [
    'uses' => 'BW\Util\Relationships\Image\ImageApiController@getRemove',
    'as' => 'bw.relationships.image.remove',
]);

Route::post('image/upload', [
    'uses' => 'BW\Util\Relationships\Image\ImageApiController@postUpload',
    'as' => 'bw.relationships.image.upload',
]);
