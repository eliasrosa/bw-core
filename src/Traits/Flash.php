<?php

namespace BW\Traits;

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
