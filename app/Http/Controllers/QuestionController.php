<?php

namespace App\Http\Controllers;

use App\Models\Question;

class QuestionController extends Controller
{

    /**
     * Store a new question.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getCategoryQuestions($id)
    {
        $questions = Question::where('question_category_id', $id)->get();

        return response()->json($questions);
    }

    public function getRandomQuestions()
    {
        $randomQuestions = Question::all()->random(2);

        return response()->json($randomQuestions);
    }
}
