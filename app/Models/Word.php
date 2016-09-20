<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Word extends Model
{
    use SoftDeletes;

    protected $table = 'words';

    protected $fillable = ['content', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lessonWords()
    {
        return $this->hasMany(LessonWord::class);
    }

    public function userWords()
    {
        return $this->hasMany(UserWord::class);
    }

    public function wordAnswers()
    {
        return $this->hasMany(WordAnswer::class);
    }
}
