<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordAnswer extends Model
{
    protected $table = 'word_answers';

    protected $fillable = ['word_id', 'content', 'correct'];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
