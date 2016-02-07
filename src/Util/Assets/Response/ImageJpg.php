<?php

namespace BW\Util\Assets\Response;

use BW\Util\Assets\Response as ControllerResponse;

class ImageJpg extends ControllerResponse
{
    public function init()
    {
        $this->response->header("Content-Type", 'image/jpg');

        return $this->response;
    }
}
