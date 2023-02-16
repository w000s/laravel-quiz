<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;


class AnswerController extends Controller
{
    public function getCategoryAnswers($id)
    {
        $answers = Answer::where('question_category_id', $id)->get();

        foreach ($answers as $answer) {
            $answer->answer_list = $this->mergeRandomWithCorrectAnswers($answer->answer);
        }

        return response()->json($answers);
    }

    public function getRandomAnswers()
    {
        $randomAnswers = Answer::all()->random(10);

        foreach ($randomAnswers as $randomAnswer) {
            $randomAnswer->answers = $this->mergeRandomWithCorrectAnswers($randomAnswer->answer);
        }

        return response()->json($randomAnswers);
    }

    // dit op id laten checken
    public function mergeRandomWithCorrectAnswers(string $answer)
    {
        // pick three random answers that is not the correct answer, and add the correct answer to this array, shuffle the positions so this will be randomized.
        return Answer::pluck('answer')->whereNotIn('answer', $answer)->random(3)->push($answer)->shuffle();
    }
}
