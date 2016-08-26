<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word_answer extends Model
{
    protected $table = "word_answers";

    protected $fillable = [
        'word_id', 'content', 'correct'
    ];

    public function word(){
        return $this->belongsTo('App\Models\Word');
    }
}
