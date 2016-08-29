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
    protected $fillable = ['name', 'email', 'password', 'avatars', 'roles'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function relationships()
    {
        return $this->belongsToMany(Relationship::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }

    public function lessonResults()
    {
        return $this->hasMany(LessonResult::class);
    }

    public function userWords()
    {
        return $this->hasMany(UserWord::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
