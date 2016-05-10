<?php

namespace BW\Controllers;

use Validator;
use BW\Models\User;
use BW\Util\Menu\Menu;
use BW\Forms\UserForm;
use Illuminate\Http\Request;
use BW\Util\DataGrid\DataGrid;
use BW\Controllers\BaseController;

class UsersGroupsController extends BaseController
{

    //
    public function index(){

        //dd(\Route::getRoutes());



        //
        return \Route::currentRouteName();
    }



}
