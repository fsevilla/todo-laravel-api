<?php

namespace App\Models\v1;
use Illuminate\Database\Eloquent\Model;
use App\Models\v1\Resource;

class Permission extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';
    
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
     * Filter by resource
     *
     * @method scopeOfResource
     * @param  QueryBuilder $query
     * @param  String $resource_name
     * @return QueryBuilder
     */
    public function scopeOfResource($query, $resource_name)
    {
        $table = $this->getTable();
        $resourcesTable = (new Resource())->getTable();

        return $query
                    ->selectRaw('resource_permissions.resource_id, '.$resourcesTable.'.resource, '.$table.'.*')
                    ->join('resource_permissions', 'resource_permissions.permission_id', '=', $table.'.id')
                    ->join($resourcesTable, 'resource_permissions.resource_id', '=', $resourcesTable.'.id')
                    ->where($resourcesTable.'.resource', 'like', $resource_name);
    }

    /**
     * Filter by User type
     *
     * @method scopeForUserType
     * @param  QueryBuilder $query
     * @param  Integer $user_type_id
     * @return QueryBuilder
     */
    public function scopeForUserType($query, $user_type_id)
    {
        $table = $this->getTable();
        $resourcesTable = (new Resource())->getTable();

        return $query
                    ->selectRaw("resources.resource, permissions.permission")
                    ->leftJoin('role_permissions', 'role_permissions.permission_id', '=', $table.'.id')
                    ->leftJoin($resourcesTable, 'role_permissions.resource_id', '=', $resourcesTable.'.id')
                    ->where('role_permissions.user_type_id', '=', $user_type_id);
    }
}
