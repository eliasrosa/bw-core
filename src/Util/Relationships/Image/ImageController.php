<?php

namespace BW\Util\Relationships\Image;

use Auth;
use Image;
use Config;
use Storage;
use Closure;
use Intervention\Image\ImageManager;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response as IlluminateResponse;

class ImageController extends BaseController
{
    //
    public function getResponse($template, $filename)
    {
        switch (strtolower($template)) {
            case 'original':
                return $this->getOriginal($filename);

            case 'download':
                return $this->getDownload($filename);

            default:
                return $this->getImage($template, $filename);
        }
    }

    //
    public function getImage($template, $filename)
    {
        $template = $this->getTemplate($template);
        $path = $this->getImagePath($filename);

        // image manipulation based on callback
        $manager = new ImageManager([
            'driver' => config('bw.images.driver'),
        ]);
        $content = $manager->cache(function ($image) use ($template, $path) {

            if ($template instanceof Closure) {
                // build from closure callback template
                $template($image->make($path));
            } else {
                // build from filter template
                $image->make($path)->filter($template);
            }

        }, config('bw.images.lifetime'));

        return $this->buildResponse($content);
    }

    //
    public function getOriginal($filename)
    {
        // check permission
        if(!config('bw.images.allow_acess_original') && Auth::guest()){
            abort(401, 'Unauthorized');
        }

        //
        $path = $this->getImagePath($filename);
        return $this->buildResponse(file_get_contents($path));
    }

    //
    public function getDownload($filename)
    {
        // check permission
        if(!config('bw.images.allow_acess_download') && Auth::guest()){
            abort(401, 'Unauthorized');
        }

        $response = $this->getOriginal($filename);
        return $response->header(
            'Content-Disposition',
            'attachment; filename=' . $filename
        );
    }

    //
    private function getTemplate($template)
    {
        $template = config("bw.images.templates.{$template}");

        switch (true) {
            // closure template found
            case is_callable($template):
                return $template;

            // filter template found
            case class_exists($template):
                return new $template;

            default:
                // template not found
                abort(404);
                break;
        }
    }

    //
    private function getImagePath($filename)
    {
        // don't allow '..' in filenames
        $image_path = storage_path('app/' . config('bw.images.storage')) . '/' . str_replace('..', '', $filename);
        if (file_exists($image_path) && is_file($image_path)) {
            return $image_path;
        }

        // file not found
        abort(404);
    }

    //
    private function buildResponse($content)
    {
        // define mime type
        $mime = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $content);

        // return http response
        return new IlluminateResponse($content, 200, array(
            'Content-Type' => $mime,
            'Cache-Control' => 'max-age='.(config('bw.images.lifetime')*60).', public',
            'Etag' => md5($content)
        ));
    }
}
