<?php

namespace BW\Admin\Util\Menu;

class Menu
{
    private $links = [];

    public function add($titulo, $route, $class = null)
    {
        $link = [
            'titulo' => $titulo,
            'route' => $route,
            'class' => $class,
        ];

        $this->links[] = $link;
    }

    public function build($view = '')
    {
        ($view == '') and $view = 'BW::util.menu.links';

        return view($view)
            ->with([
                'links' => $this->links
            ]);
    }
}
