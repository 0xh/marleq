<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function tips()
    {
        return $this->hasMany('App\Tip');
    }
}