<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'status', 'alias', 'title', 'certification', 'country', 'email', 'password', 'picture', 'picture_crop', 'document', 'biography', 'free_cv'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function testimonials()
    {
        return $this->hasMany('App\Testimonial');
    }

    public function specialties()
    {
        return $this->belongsToMany('App\Specialty');
    }

    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

    public function countries()
    {
        return $this->belongsToMany('App\Country');
    }

    public function languages()
    {
        return $this->belongsToMany('App\Language');
    }
}
