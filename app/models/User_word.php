<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_word extends Model
{
    protected $table = "user_words";

    protected $fillable = [
        'user_id', 'word_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function word(){
        return $this->belongsTo('App\Models\Word');
    }
}
