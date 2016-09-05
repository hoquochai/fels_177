<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $table = 'activities';

    protected $fillable = ['target_id', 'user_id', 'action_type'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
