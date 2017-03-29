<?php

Route::resource('tag', '\BW\Util\Relationships\Tag\TagController', ['except' => ['show']]);
