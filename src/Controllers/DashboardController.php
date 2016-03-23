<?php

namespace BW\Controllers;

use BW\Controllers\BaseController;

class DashboardController extends BaseController
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
