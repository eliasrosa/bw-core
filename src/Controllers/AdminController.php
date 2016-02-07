<?php

namespace BW\Controllers;

use BW\Controllers\BaseController;

class AdminController extends BaseController
{
    //
    public function __construct(){
        $this->setViewNamespace('BW\Admin');
    }

    //
    public function dashboard(){

        //
        $this->makeViewContent('dashboard');

        //
        return $this->getLayout();
    }
}
