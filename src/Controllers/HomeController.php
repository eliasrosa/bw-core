<?php

namespace BW\Controllers;

use BW\Controllers\BaseController;

class HomeController extends BaseController
{
    //
    public function index(){

        //
        return $this->view('home');
    }
}
