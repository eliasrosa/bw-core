<?php

Route::resource('listing', '\BW\Util\Relationships\Listing\ListingController', ['except' => ['show']]);
