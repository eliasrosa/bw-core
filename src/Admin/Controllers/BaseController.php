<?php

namespace BW\Admin\Controllers;

use BW\Admin\Traits\Flash;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use Flash;

    /**
     * Show view.
     *
     * @param $view
     * @param array $data
     * @param array $mergeData
     *
     * @return mixed
     */
    public function view($view, $data = array(), $mergeData = array())
    {
        //
        if(!preg_match('/\:\:/',$view)){
            $view = config('bw.views.' . $view, 'BW::' . $view);
        }

        return \View::make($view, $data, $mergeData);
    }

}
