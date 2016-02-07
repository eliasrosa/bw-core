<?php

namespace BW\Util\Assets\Response;

use BW\Util\Assets\Response as ControllerResponse;

class ImagePng extends ControllerResponse
{
    public function init()
    {
        $this->response->header("Content-Type", 'application/javascript');

        return $this->response;
    }
}
