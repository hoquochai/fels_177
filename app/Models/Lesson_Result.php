<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonResult extends Model
{
    protected $table = 'lesson_results';

    protected $fillable = ['user_id', 'lesson_id', 'result'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
