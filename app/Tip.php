<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'timestamps'
    ];

    public function tipType()
    {
        return $this->belongsTo('App\TipType');
    }

    public function resumes()
    {
        return $this->belongsToMany('App\Resume');
    }
}
