<?php
//
// Image
//
Route::get('image/{relation_id}/{ref_id}', [
    'uses' => 'BW\Util\Relationships\Image\ImageApiController@getImage',
    'as' => 'bw.relationships.image.get',
]);

Route::get('image/{relation_id}/{ref_id}/remove', [
    'uses' => 'BW\Util\Relationships\Image\ImageApiController@getRemove',
    'as' => 'bw.relationships.image.destroy',
]);

Route::post('image/{relation_id}/{ref_id}/upload', [
    'uses' => 'BW\Util\Relationships\Image\ImageApiController@postUpload',
    'as' => 'bw.relationships.image.upload',
]);


//
// Gallery
//
Route::get('image/gallery/{relation_id}/{ref_id}', [
    'uses' => 'BW\Util\Relationships\Image\GalleryApiController@getImages',
    'as' => 'bw.relationships.image.gallery.get',
]);

Route::post('image/gallery/{relation_id}/{ref_id}/upload', [
    'uses' => 'BW\Util\Relationships\Image\GalleryApiController@postUpload',
    'as' => 'bw.relationships.image.gallery.upload',
]);
