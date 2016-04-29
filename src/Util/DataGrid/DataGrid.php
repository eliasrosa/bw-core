<?php

namespace BW\Util\DataGrid;

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
}
