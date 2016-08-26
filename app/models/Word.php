<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $table = "words";

    protected $fillable = [
        'content', 'category_id'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function lesson_words(){
        return $this->hasMany('App\Models\Lesson_word');
    }

    public function user_words(){
        return $this->hasMany('App\Models\User_word');
    }

    public function word_answers(){
        return $this->hasMany('App\Models\Word_answer');
    }
}
