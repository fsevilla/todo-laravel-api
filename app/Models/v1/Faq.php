<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;

class Faq extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'faq',
        'answer',
        'position',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 
    ];

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
        return $query->orderBy('position', 'ASC');
    }

    /**
     * Sort by Inversed Position
     *
     * @method scopeInversed
     * @param  QueryBuilder $query
     * @return QueryBuilder
     */
    public function scopeInversed($query)
    {
        return $query->orderBy('position', 'DESC');
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
