<?php

namespace BW\Controllers;

use BW\Models\Usuario;
use BW\Util\DataGrid\DataGrid;
use BW\Controllers\BaseController;

class UsuariosController extends BaseController
{
    //
    public function __construct(){
        $this->setViewNamespace('BW\Admin');
    }

    //
    public function index(){

        $filter = \DataFilter::source(\DB::table('bw_usuarios'));
        $filter->add('nome','Nome', 'text');
        $filter->submit('Pesquisar');
        $filter->reset('Limpar');
        $filter->build();

        $grid = DataGrid::source($filter);
        $grid->add('id', 'ID', true);
        $grid->add('nome', 'Nome', true);
        $grid->add('email', 'E-mail', true);
        $grid->add('status', 'Status', true);

        $grid->link('teste',"Novo Usuário");
        $grid->orderBy('id','desc');

        //
        $this->makeViewContent('usuarios.lista')
            ->with([
                'filter' => $filter,
                'grid' => $grid->build()
                    ->with('filter', $filter)
             ]);

        //
        return $this->getLayout();
    }
}
