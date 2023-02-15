<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;


class AnswerController extends Controller
{
    public function retrieveAnswers($id)
    {
        $answers = Answer::where('question_category_id', $id)->get();

        return $answers;
    }
}
