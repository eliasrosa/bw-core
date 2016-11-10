<?php

Route::get('image/{id}/remove', [
    'uses' => 'BW\Util\Relationships\Image\ImageController@getRemove',
    'as' => 'bw.relationships.image.destroy',
]);
