<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use SoftDeletes;

    protected $table = 'lessons';

    protected $fillable = ['category_id', 'name'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lessonResults()
    {
        return $this->hasMany(LessonResult::class);
    }

    public function lessonWords()
    {
        return $this->hasMany(LessonWord::class);
    }
}
