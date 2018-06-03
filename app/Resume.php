<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document', 'rating', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'timestamps'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function coach()
    {
        return $this->belongsTo('App\User');
    }

    public function tips()
    {
        return $this->belongsToMany('App\Tip');
    }
}
