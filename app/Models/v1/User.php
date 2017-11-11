<?php

namespace App\Models\v1;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Include user_type name
     *
     * @method scopeWithUserType
     * @param  QueryBuilder $query
     * @return QueryBuilder
     */
    public function scopeWithUserType($query)
    {
        $table = $this->getTable();
        return $query->join('user_types', $table.'.user_type_id', '=', 'user_types.id');
    }
}
