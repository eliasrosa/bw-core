<?php

namespace BW\Util\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class ImageSmallFilter implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(100, 100, function($i){
            $i->aspectRatio();
        });
    }
}
