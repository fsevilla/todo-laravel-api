<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Todo extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'status_id' ,
        'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 
    ];

    public $timestamps = true;

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

    /**
     * Filter for user
     *
     * @method scopeFromUser
     * @param  QueryBuilder $query
     * @return QueryBuilder
     */
    public function scopeFromUser($query, $user_id)
    {
        $table = $this->getTable();
        return $query->where($table.'.user_id', '=', $user_id);
    }

    /**
     * Include status
     *
     * @method scopeWithStatus
     * @param  QueryBuilder $query
     * @return QueryBuilder
     */
    public function scopeWithStatus($query)
    {
        $table = $this->getTable();
        $statusTable = (new Status())->getTable();
        return $query
                    ->select($table.'.*', $statusTable.'.status')
                    ->join('status', $table.'.status_id', '=', $statusTable.'.id');
    }

    /**
     * Filter for logged in user only
     *
     * @method scopeMine
     * @param  QueryBuilder $query
     * @return QueryBuilder
     */
    public function scopeMine($query)
    {
        $user_id = Auth::user()->id;
        $table = $this->getTable();
        return $query->where($table.'.user_id', '=', $user_id);
    }
}
