<?php

namespace BW\Controllers;

use View;
use Config;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    public function makeViewContent($view, $layout = null){

        //
        $this->makeLayout($layout);

        //
        if(!preg_match('/\:\:/',$view)){
            $view = $this->component_namespace . '::' . $view;
        }

        //
        $this->layout->content = view($view);
        return $this->layout->content;
    }

    public function getLayout(){
        return $this->layout;
    }

    public function makeLayout($view = null){

        if(is_null($view)){
            $view = Config::get('bw.admin.views.layout');
        }

        $this->layout = View::make($view)
            ->with([
                'menu' => Layout\MenuController::makeLayout(),
                'busca' =>  Layout\BuscaController::makeLayout(),
                'info' =>  Layout\InfoController::makeLayout(),
            ]
        );
    }
}
