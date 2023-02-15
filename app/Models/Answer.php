<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer',
        'incorrect_answers',
    ];

    public function answerType()
    {
        return $this->hasOne(AnswerType::class);
    }
}
