<?php

namespace BW\Controllers;

use BW\Controllers\BaseController;

class DashboardController extends BaseController
{
    //
    public function dashboard(){

        //
        return $this->view('dashboard');
    }
}
