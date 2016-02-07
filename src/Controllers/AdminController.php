<?php

namespace BW\Controllers;

use BW\Controllers\BaseController;

class AdminController extends BaseController
{
    //
    protected $component_namespace = 'BW\Admin';

    //
    public function dashboard(){

        //
        $this->makeViewContent('dashboard');

        //
        return $this->getLayout();
    }
}
