<?php

namespace App\Models\v1;
use Illuminate\Database\Eloquent\Model;

class Resource extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'resource',
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
     * Include user_type name
     *
     * @method scopeWithUserType
     * @param  QueryBuilder $query
     * @return QueryBuilder
     */
    public function scopeWithPermissions($query)
    {
        $table = $this->getTable();
        return $query->join('user_types', $table.'.user_type_id', '=', 'user_types.id');
    }
}
