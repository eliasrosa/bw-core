<?php

namespace BW\Admin\Controllers;

use BW\Admin\Controllers\BaseController;

class DashboardController extends BaseController
{
    //
    public function dashboard(){

        //
        return $this->view('dashboard');
    }
}
