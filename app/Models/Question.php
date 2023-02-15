<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuestionCategory;
use App\Models\AnswerType;



class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'answers',
        'answer_type_id',
        'question_category_id'
    ];

    public function category()
    {
        return $this->hasOne(QuestionCategory::class);
    }
}
