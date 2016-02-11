<?php

namespace BW\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $login_url = Config('bw.admin.url') . '/login';
        $assets_url = Config('bw.admin.url') . '/assets/*';


        if ($this->auth->guest()) {
            if ($request->ajax() or $request->is($assets_url)) {
                return response('Unauthorized.', 401);
            }else {
                return redirect()->guest($login_url);
            }
        }

        return $next($request);
    }
}
