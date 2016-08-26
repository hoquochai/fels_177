<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = "lessons";

    protected $fillable = [
        'category_id', 'name'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function lesson_results(){
        return $this->hasMany('App\Models\Lesson_result');
    }

    public function lesson_words(){
        return $this->hasMany('App\Models\Lesson_word');
    }
}
