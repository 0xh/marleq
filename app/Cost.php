<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price', 'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }
}
