<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'roles'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function relationships(){
        return $this->belongsToMany('App\Users\Relationship');
    }

    public function activities(){
        return $this->belongsToMany('App\Users\Activity');
    }

    public function lesson_results(){
        return $this->hasMany('App\Models\Lesson_result');
    }

    public function user_words(){
        return $this->hasMany('App\Models\User_word');
    }
}
