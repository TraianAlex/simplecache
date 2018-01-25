<?php

namespace Vic\Laracache;

use Closure;
use Cache;

class FlashViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(app()->environment() === 'local'){
            //Cache::tags('views')->flush();
            Cache::flush();
        }
        return $next($request);
    }
}
