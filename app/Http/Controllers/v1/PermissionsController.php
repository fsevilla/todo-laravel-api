<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\CustomController;
use App\Providers\ResponseProvider as Response;
use Illuminate\Http\Request;
use App\Models\v1\Permission;
use App\Libraries\CoreHelper;
use Auth;

class PermissionsController extends CustomController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index(Permission $permission, Request $request)
    {
        if($request->input('resource')){
            $permission = $permission->ofResource($request->input('resource'));
        }
        return $this->getItems($permission);
    }

    public function show($id)
    {
        $permission = Permission::find($id);
        if($permission){
            return Response::json($permission);
        } else {
            return Response::error(404, 'item not found');
        }
    }

    public function getUserPermissions()
    {
        $userType = Auth::user()->user_type_id;
        $Permission = new Permission();
        $user_permissions = $Permission->forUserType($userType)->get()->toArray();
        $grouped_permissions = array();
        foreach($user_permissions as $permission) {
            if(!isset($grouped_permissions[$permission['resource']])) {
                $grouped_permissions[$permission['resource']] = array();
            }

            $grouped_permissions[$permission['resource']][] = $permission['permission'];
        }
        return $grouped_permissions;
    }
}
