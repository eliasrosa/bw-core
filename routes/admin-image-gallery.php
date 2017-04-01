<?php
//
// Image Gallery
//
Route::get('image/gallery/{relation_id}/{ref_id}', [
    'uses' => 'BW\Util\Relationships\Image\GalleryApiController@getImages',
    'as' => 'bw.relationships.image.gallery.get',
]);

Route::post('image/gallery/{relation_id}/{ref_id}/upload', [
    'uses' => 'BW\Util\Relationships\Image\GalleryApiController@postUpload',
    'as' => 'bw.relationships.image.gallery.upload',
]);

Route::get('image/gallery/{relation_id}/{ref_id}/{id}/remove', [
    'uses' => 'BW\Util\Relationships\Image\GalleryApiController@getRemove',
    'as' => 'bw.relationships.image.gallery.destroy',
]);

Route::post('image/gallery/{relation_id}/{ref_id}/reorder', [
    'uses' => 'BW\Util\Relationships\Image\GalleryApiController@postReorder',
    'as' => 'bw.relationships.image.gallery.reorder',
]);
