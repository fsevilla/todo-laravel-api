<?php

namespace App\Http\Middleware;

use App\Providers\ResponseProvider as Response;
use App\Models\v1\Role as UserType;
use Auth;
use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {

        switch ($role) { 
            case 'sadmin':
                $roles = ['super administrator'];
                break;

            case 'admin':
                $roles = ['super administrator', 'administrator'];
                break;
            
            default:
                $roles = [];
                $roles[] = strtolower($role);
                break;
        }

        $user_type = UserType::find(Auth::user()->user_type_id)->user_type;
        
        if(in_array(strtolower($user_type), $roles)){
            return $next($request);
        } else {
            return Response::error(403, 'unauthorized');
        }
    }
}
