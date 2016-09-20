<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonResult extends Model
{
    use SoftDeletes;

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
