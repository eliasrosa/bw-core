<?php

namespace BW\Util\DataGrid;

use Zofe\Rapyd\DataGrid\DataGrid as ZofeDataGrid;

class DataGrid extends ZofeDataGrid
{
    public $attributes = array("class" => "table table-hover");

    public function build($view = '')
    {
        ($view == '') and $view = 'BW\Util\DataGrid::datagrid';
        return parent::build($view);
    }

    public function link($url, $name, $position="TR", $attributes=array())
    {
        return parent::link($url, $name, $position, $attributes);
    }
}
