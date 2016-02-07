<?php

namespace BW\Util\Assets\Response;

use BW\Util\Assets\Response as ControllerResponse;

class CommonFiles extends ControllerResponse
{
    public function init()
    {

    	$types = [

            // Common files
            'jpg' => 'image/jpg',
            'png' => 'image/png',
            'ico' => 'image/x-icon',
            'js'  => 'application/javascript',
            'css' => 'text/css',

            // Common fonts
    		'ttf' => 'application/x-font-ttf',
    		'eot' => 'application/vnd.ms-fontobject',
    		'svg' => 'image/svg+xml',
    		'woff' => 'application/x-font-woff',
    		'woff2' => 'application/x-font-woff2',
    	];

        $header = array_get($types, $this->ext);

        if(is_array($header)){
            foreach ($header as $key => $value) {
                $this->response->header($key, $value);
            }
        }else{
            $this->response->header("Content-Type", $header);
        }

        return $this->response;
    }
}
