<?php

namespace BW\Util\DataGrid;

use BW\Helpers\Html;
use Zofe\Rapyd\DataGrid\DataGrid as ZofeDataGrid;

class DataGrid extends ZofeDataGrid
{
    public $attributes = array("class" => "table table-hover");

    public static function source($source)
    {
        $ins = parent::source($source);
        $ins->paginate(20);

        return $ins;
    }

    public function build($view = '')
    {
        ($view == '') and $view = 'BW::util.datagrid.grid';
        return parent::build($view);
    }

    public function link($url, $name, $position="TR", $attributes=array())
    {
        return parent::link($url, $name, $position, $attributes);
    }

    public function addOptions($route_edit, $route_delete)
    {

        //
        Html::addJS(asset('/packages/eliasrosa/bw-core/util/grid/remove.js'));

        //
        $this->add('opcoes', 'Opções')->cell(function($a, $b) use ($route_edit, $route_delete){
            $html = '';

            //
            $html .= sprintf('<a href="%s" class="btn btn-primary btn-xs">Editar</a> ',
                route($route_edit, $b->id)
            );

            //
            $html .= sprintf('<form action="%s" style="display: inline-block" method="POST">' . csrf_field() .
                              '<input type="hidden" name="_method" value="DELETE">' .
                              '<input type="submit" class="btn btn-danger btn-xs" value="Remover">' .
                              '</form>', route($route_delete, $b->id)
            );

            return $html;
        });
    }


    public function addBoolean($name, $title, $str_true, $str_false)
    {
        $this->add($name, $title, true)->cell(function($a, $b) use ($name, $str_true, $str_false){
            if((bool) $b->$name){
                return '<span class="label label-success">' . $str_true . '</span>';
            }else{
                return '<span class="label label-danger">' . $str_false . '</span>';
            }
        });
    }


    public function addStatus()
    {
        $this->addBoolean('status', 'Status', 'Ativado', 'Desativado');
    }

}
