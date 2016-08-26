<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson_result extends Model
{
    protected $table = "lesson_results";

    protected $fillable = [
        'user_id', 'lesson_id', 'result'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function lesson(){
        return $this->belongsTo('App\Models\Lesson');
    }
}
