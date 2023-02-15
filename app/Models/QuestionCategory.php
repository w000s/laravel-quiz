<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;


class QuestionCategory extends Model
{
    use HasFactory;

    // is not input data so this should be changed
    protected $fillable = [
        'category_name'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'foreign_key');
    }
}
