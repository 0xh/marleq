<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'timestamps'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function costs()
    {
        return $this->hasMany('App\Cost');
    }
}
