<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncorrectAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer_id',
        'incorrect_answer',
    ];

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
