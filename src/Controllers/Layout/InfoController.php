<?php

namespace BW\Controllers\Layout;

use Auth;
use View;
use Config;

class InfoController
{
    //
    static public function makeLayout(){

        //
        return View::make(Config::get('bw.admin.views.info'))
            ->with('email', Auth::user()->nome);
    }
}
