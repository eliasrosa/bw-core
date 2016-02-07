<?php

namespace BW\Util\Assets\Response;

use BW\Util\Assets\Response as ControllerResponse;

class FontTTF extends ControllerResponse
{
    public function init()
    {
        $this->response->header("Content-Type", 'application/x-font-ttf');

        return $this->response;
    }
}
