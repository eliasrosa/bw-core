<?php

foreach (BW\Core\Assets::getAll($middleware) as $i) {

    Route::get('assets/' . $i['prefix'] . '/{url}.{ext}', function() use ($i) {

        $url = Request::route('url');
        $ext = Request::route('ext');

        $params = [
            'url' => $url,
            'extension' => $ext,
            'path' => $i['path'] . '/' . $url . '.' . $ext,
        ];

        if(!is_file($params['path'])){
            abort(404);
        }

        //
        $controller_name = Config::get('bw.util.assets.controllers.'. $ext,'BW\Util\Assets\AssetsController');
        $controller = app()->make($controller_name, $params);

        //
        //return \Cache::remember(Request::url(), Config::get('bw.assets.cache', 0), function() use ($controller){
            return $controller->callAction('init', []);
        //});

    })->where([
        'url' => '[a-zA-Z0-9\/\.\_\-]+',
        'ext' => '[a-zA-Z0-9]+',
    ]);
}
