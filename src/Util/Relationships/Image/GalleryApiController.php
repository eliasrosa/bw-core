<?php

namespace BW\Util\Relationships\Image;

use Input;
use Image;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use BW\Util\Relationships\Image\Models\Gallery as GalleryModel;

class GalleryApiController extends BaseController
{
    //
    public function getImages(Request $request)
    {
        //
        $images = GalleryModel::where([
            'relation_id' => $request->get('relation_id'),
            'ref_id' => $request->get('ref_id')
        ])
        ->orderBy('position', 'asc')
        ->get();

        return response()->json([
            'error' => false,
            'data' => $images->toArray(),
        ]);
    }

    //
    public function postReorder(Request $request)
    {
        //
        $positions = request('positions', []);
        $images = request('images', []);

        $result = GalleryModel::where([
            'relation_id' => $request->get('relation_id'),
            'ref_id' => $request->get('ref_id')
        ])->whereIn('id', $request->get('images', []))->get();

        //
        foreach ($images as $k => $id) {
            $i = $result->find($id);
            $i->position = $positions[$k];
            $i->save();
        }

        return response()->json([
            'error' => false,
            'data' => [],
        ]);
    }


    //
    public function postUpload(Request $request)
    {
        //
        $file = Input::file('imagem');

        //
        $validator = Validator::make([
            'imagem' => $file
        ], [
            'imagem' => 'required|mimes:jpeg,bmp,png|max:5000',
        ]);

        if($validator->fails()){
            $errors = $validator->errors();

            return response()->json([
                'error' => true,
                'message' => $errors->first('imagem'),
            ]);
        }

        //
        $img = Image::make($file);

        //
        $image = new GalleryModel();
        $image->position = request('position', 0);
        $image->ref_id = $request->get('ref_id');
        $image->relation_id = $request->get('relation_id');
        $image->type = last(explode('/', $img->mime()));
        $image->save();

        //
        $img->save($image->getPath());

        //
        return response()->json([
            'error' => false,
            'message' => 'Imagem enviada com sucesso!',
            'data' => $image->toArray(),
        ]);

    }

    //
    public function getRemove(Request $request){

        // find
        $image = GalleryModel::where([
            'relation_id' => $request->get('relation_id'),
            'ref_id' => $request->get('ref_id'),
            'id' => $request->get('id'),
        ])->first();

        if($image){

            // delete file
            if(file_exists($image->getPath())){
               unlink($image->getPath());
            }

            // delete record
            $image->delete();

            // redirect
            return response()->json([
                'error' => false,
                'message' => 'Imagem removida com sucesso!'
            ]);
        }
        
        //
        return response()->json([
            'error' => true,
            'message' => 'Imagem não encontrada!',
        ]);
    }

}
