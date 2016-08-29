<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = ['target_id', 'user_id', 'action_type'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
