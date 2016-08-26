<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $table = "relationships";

    protected $fillable = [
        'following_id', 'follower_id'
    ];

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
