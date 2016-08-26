<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson_word extends Model
{
    protected $table = "lesson_words";

    protected $fillable = [
        'lesson_id', 'word_id'
    ];

    public function lesson(){
        return $this->belongsTo('App\Models\Lesson');
    }

    public function word(){
        return $this->belongsTo('App\Models\Word');
    }
}
