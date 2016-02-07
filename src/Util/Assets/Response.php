<?php

namespace BW\Util\Assets;

use File;
use Response as LaravelResponse;
use Illuminate\Routing\Controller as Controller;

class Response extends Controller
{

    protected $response;

    public function __construct($path, $url, $ext)
    {
        $this->path = $path;
        $this->url = $url;
        $this->ext = $ext;

        $this->response = LaravelResponse::make($this->getContents(), 200);
    }

    private function getContents()
    {
        return File::get($this->path);
    }

}
