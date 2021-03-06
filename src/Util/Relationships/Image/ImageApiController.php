<?php

namespace BW\Util\Relationships\Image;

use Input;
use Image;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use BW\Util\Relationships\Image\Models\Image as ImageModel;

class ImageApiController extends BaseController
{
    //
    public function getImage(Request $request)
    {
        //
        $image = ImageModel::where([
            'relation_id' => $request->get('relation_id'),
            'ref_id' => $request->get('ref_id')
        ])->first();

        if($image){
            return response()->json([
                'error' => false,
                'data' => $image->toArray(),
            ]);
        }

        //
        return response()->json([
            'error' => true,
            'message' => 'Imagem não encontrada!',
        ]);
    }

    //
    public function postUpload(Request $request)
    {
        //
        $relation_id = $request->get('relation_id');
        $ref_id = $request->get('ref_id');
        $file = $request->file('imagem');

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
        $this->destroy($relation_id, $ref_id);
        
        //
        $img = Image::make($file);

        //
        $image = new ImageModel();
        $image->position = Input::get('position', 0);
        $image->ref_id = $ref_id;
        $image->relation_id = $relation_id;
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
    public function getRemove(Request $request)
    {
        //
        $relation_id = $request->get('relation_id');
        $ref_id = $request->get('ref_id');

        //
        if($this->destroy($relation_id, $ref_id)){

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

    //
    private function destroy($relation_id, $ref_id){

        // find
        $image = ImageModel::where([
            'relation_id' => $relation_id,
            'ref_id' => $ref_id
        ])->first();

        if($image){

            // delete record
            $image->delete();

            //
            return true;
        }

        return false;
    }

}
