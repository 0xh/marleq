<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_to_id',
        'user_from_id',
        'message'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_from_id');
    }

    public function usersTo()
    {
        return $this->belongsTo('App\User', 'user_to_id');
    }
}
