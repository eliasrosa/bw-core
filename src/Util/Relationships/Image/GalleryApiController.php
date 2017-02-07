<?php

namespace BW\Util\Relationships\Image;

use BW\Util\Relationships\Image\Models\Gallery as GalleryModel;

class GalleryApiController extends ImageApiController
{
    //
    public function getImages($relation_id, $ref_id)
    {
        //
        $images = GalleryModel::where([
            'relation_id' => $relation_id,
            'ref_id' => $ref_id
        ])
        ->orderBy('position')
        ->get();

        return response()->json([
            'error' => false,
            'data' => $images->toArray(),
        ]);
    }


}
