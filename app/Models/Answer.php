<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer',
        'answer_list',
    ];

    public function answerType()
    {
        return $this->hasOne(AnswerType::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'foreign_key');
    }

    public function category()
    {
        return $this->hasOne(QuestionCategory::class);
    }
}
