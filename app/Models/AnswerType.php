<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerType extends Model
{
    protected $values = [
        'type_name',
    ];

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'foreign_key');
    }
}
