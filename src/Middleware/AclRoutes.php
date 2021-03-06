<?php

namespace BW\Middleware;

use Closure;

class AclRoutes
{
    //
    protected $auth;

    //
    protected $ignore_routes = [];

    //
    public function __construct()
    {
        $this->auth = \Auth::user();
        $this->ignore_routes = config('bw.middleware.aclroutes.ignore_routes', []);
    }

    //
    public function handle($request, Closure $next)
    {
        //
        $route_name = \Route::currentRouteName();
        $message = 'Acesso negado!';

        if(!in_array($route_name, $this->ignore_routes)){

            //
            if($this->auth->hasPermission($route_name) === false){
                if ($request->ajax()) {
                    return response($message, 403);
                }else {
                    app('flash')->error($message);
                    return back();
                }
            }
        }

        return $next($request);
    }
}
