<?php

namespace BW\Util\Relationships\Listing;

use Closure;

class ListingMiddleware
{
    //
    private function getRelation($relation_id)
    {
        return \BWAdmin::get('relationships')->get()
            ->where('id', $relation_id)
            ->first();
    }

    //
    public function handle($request, Closure $next)
    {
        //
        $relation_id = $request->get('relation_id');
        $relation = $this->getRelation($relation_id);

        //
        if(!$relation) {
            $message = 'Ops! Lista não encontrada!';
            if ($request->ajax()) {
                return response($message, 404);
            }else{
                app('flash')->error($message);
                return back();
            }
        }

        return $next($request);
    }
}
