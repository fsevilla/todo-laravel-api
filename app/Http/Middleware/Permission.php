<?php

namespace App\Http\Middleware;

use App\Providers\ResponseProvider as Response;
use App\Models\v1\ACL;
use Closure;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $action, $resource)
    {
        if(ACL::isAllowed($resource, $action)){
            return $next($request);
        } else {
            return Response::error(403, 'unauthorized');
        }
    }
}
