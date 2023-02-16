<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer',
        'answer_type_id',
        'answer_list',
        'question_category_id'
    ];

    public function answerType()
    {
        return $this->hasOne(AnswerType::class);
    }

    public function question()
    {
        return $this->hasOne(Question::class, 'foreign_key');
    }

    public function category()
    {
        return $this->hasOne(QuestionCategory::class);
    }
}
