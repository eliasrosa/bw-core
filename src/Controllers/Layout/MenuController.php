<?php

namespace BW\Controllers\Layout;

use View;
use Config;

class MenuController
{
    //
    static public function makeLayout(){

        //
        return View::make(Config::get('bw.admin.views.layout.menu'));
    }
}
