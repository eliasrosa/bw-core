<?php

namespace BW\Views\Composers;

use Illuminate\Contracts\View\View;

class InfoComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('email', \Auth::user()->email);
    }
}
