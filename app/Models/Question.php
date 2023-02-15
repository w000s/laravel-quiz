<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuestionCategory;



class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer_id',
        'question_category_id'
    ];


    public function answer()
    {
        return $this->hasOne(QuestionCategory::class);
    }

    public function category()
    {
        return $this->hasOne(QuestionCategory::class);
    }
}
