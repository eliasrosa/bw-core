<?php

namespace BW\Util\Assets\Response;

use BW\Util\Assets\Response as ControllerResponse;

class StyleCss extends ControllerResponse
{
    public function init()
    {
        $this->response->header("Content-Type", '');

        return $this->response;
    }
}
