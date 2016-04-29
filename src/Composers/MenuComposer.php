<?php

namespace BW\Composers;

use Illuminate\Contracts\View\View;

class MenuComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('menu', []);
    }
}
