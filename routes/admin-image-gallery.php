<?php
//
// Image Gallery
//
Route::get('image-gallery', [
    'uses' => 'BW\Util\Relationships\Image\GalleryApiController@getImages',
    'as' => 'bw.relationships.image.gallery',
]);

Route::post('image-gallery/upload', [
    'uses' => 'BW\Util\Relationships\Image\GalleryApiController@postUpload',
    'as' => 'bw.relationships.image.gallery.upload',
]);

Route::get('image-gallery/remove', [
    'uses' => 'BW\Util\Relationships\Image\GalleryApiController@getRemove',
    'as' => 'bw.relationships.image.gallery.remove',
]);

Route::post('image-gallery/reorder', [
    'uses' => 'BW\Util\Relationships\Image\GalleryApiController@postReorder',
    'as' => 'bw.relationships.image.gallery.reorder',
]);
