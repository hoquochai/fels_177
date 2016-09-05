<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WordAnswer extends Model
{
    use SoftDeletes;

    protected $table = 'word_answers';

    protected $fillable = ['word_id', 'content', 'correct'];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
