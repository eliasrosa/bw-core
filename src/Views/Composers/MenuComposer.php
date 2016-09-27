<?php

namespace BW\Views\Composers;

use Illuminate\Contracts\View\View;

class MenuComposer
{

    public $menus = [];

    public function __construct()
    {
        //
        $this->menus = \BWAdmin::get('menu')->get();

        //
        foreach ($this->menus as &$m1) {
            $m1['href'] = isset($m1['route']) ? route($m1['route']) : '#';
            $m1['route-index'] = isset($m1['route-index']) ? route($m1['route-index']) : '#';

            if(isset($m1['itens'])){
                foreach ($m1['itens'] as &$m2) {
                    $m2['href'] = isset($m2['route']) ? route($m2['route']) : '#';

                    if(isset($m2['itens'])){
                        foreach ($m2['itens'] as &$m3) {
                            $m3['href'] = isset($m3['route']) ? route($m3['route']) : '#';
                        }
                    }
                }
            }

        }
    }


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('menus', $this->menus);
    }
}
