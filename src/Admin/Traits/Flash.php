<?php

namespace BW\Admin\Traits;

trait Flash
{
    /**
     * @return \Laracasts\Flash\FlashNotifier
     */
    public function flash()
    {
        return app('flash');
    }
}
