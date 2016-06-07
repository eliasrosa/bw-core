<?php

namespace BW\Controllers\Media;

use BW\Controllers\BaseController;

class ImagesController extends BaseController
{
    //
    public function index(){

        //
        return $this->view('media.images.index');
    }
}
