<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;

class Status extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 
    ];

    public $table = 'status';
    
    public $timestamps = false;

    /**
     * Sort by Position
     *
     * @method scopeInOrder
     * @param  QueryBuilder $query
     * @return QueryBuilder
     */
    public function scopeInOrder($query)
    {
        return $query->orderBy('id', 'ASC');
    }

    public function setUpdatedAt($value)
	{
	    // Do nothing.
	}

	public function setCreatedAt($value)
	{
	    // Do nothing.
	}
}
