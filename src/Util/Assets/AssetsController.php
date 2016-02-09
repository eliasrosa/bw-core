<?php

namespace BW\Util\Assets;

use File;
use Config;
use Response;
use Illuminate\Routing\Controller as Controller;

class AssetsController extends Controller
{
    protected $response;

    public function __construct($path, $url, $extension)
    {
        $this->url = $url;
        $this->path = $path;
        $this->extension = $extension;

        $this->response = Response::make($this->getContent(), 200);
    }

    private function getContent()
    {
        return File::get($this->path);
    }

    public function init()
    {
        $header = Config::get('bw.util.assets.types.' . $this->extension);

        if(is_array($header)){
            foreach ($header as $key => $value) {
                $this->response->header($key, $value);
            }
        }else{
            //dd($header);
            $this->response->header("Content-Type", $header);
        }

        return $this->response;
    }
}
