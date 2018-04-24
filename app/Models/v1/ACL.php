<?php

namespace App\Models\v1;
use Illuminate\Database\Eloquent\Model;
use App\Models\v1\Permission;
use App\Libraries\CoreHelper;
use Auth;

class ACL extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 
    ];

    /**
     * Get logged user permissions
     *
     * @method hasPermissions
     * @param  String $resource
     * @param  String $action
     * @return Boolean
     */
    static private function getUserPermissions($resource = '')
    {
        $userType = Auth::user()->user_type_id;
        $Permission = new Permission();
        $list = $Permission->forUserType($userType)->get()->toArray();
        if($resource !== ''){
            return CoreHelper::filterByKeyValue($list, 'resource', $resource);
        } else {
            return $list;
        }
    }

    /**
     * Check if logged user has permissions
     * to the specified resource and action
     *
     * @method hasPermissions
     * @param  String $resource
     * @param  String $action
     * @return Boolean
     */
    static function isAllowed($resource, $action)
    {
        $permissions = ACL::getUserPermissions($resource);
        if($permissions !== null) {
            foreach ($permissions as $permission) {
                if($permission['permission'] === $action) {
                    return true;
                }
            }
        }
        return false;
    }
}
