<?php

Route::get($attr['prefix'] . '/{url}.{ext}', function() use ($attr) {

    $url = Request::route('url');
    $ext = Request::route('ext');

    $params = [
        'path' => $attr['path'] . '/' . $url . '.' . $ext,
        'ext' => $ext,
        'url' => $url,
    ];

    if(!File::exists($params['path'])){
        abort(404);
    }

    $controller_name = Config::get('bw.util.assets.types.' . $params['ext'], 'BW\Util\Assets\Response\CommonFiles');
    $controller = app()->make($controller_name, $params);

    return Cache::remember(Request::url(), Config::get('bw.cache', 30), function() use ($controller){
        return $controller->callAction('init', []);
    });

})->where([
    'url' => '[a-zA-Z0-9\/\.\_\-]+',
    'ext' => '[a-zA-Z0-9]+',
]);


