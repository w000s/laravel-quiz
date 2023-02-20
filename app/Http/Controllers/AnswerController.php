<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\IncorrectAnswer;

class AnswerController extends Controller
{
    public function getCategoryAnswers($id)
    {
        $categoryAnswers = Answer::where('question_category_id', $id)->get();

        // If incorrect answers are connected to the answers, use these incorrect answers, otherwise randomize answers.
        foreach ($categoryAnswers as $categoryAnswer) {
            $categoryAnswer->answer_list = $this->getIncorrectAnswers($categoryAnswer->id, $categoryAnswer->answer);

            if (count($categoryAnswer->answer_list) < 1) {
                $categoryAnswer->answer_list = $this->mergeRandomWithCorrectAnswers($categoryAnswer->answer);
            }
        }

        return response()->json($categoryAnswers);
    }

    public function getRandomAnswers()
    {
        $randomAnswers = Answer::all()->random(10);

        foreach ($randomAnswers as $randomAnswer) {
            $randomAnswer->answers = $this->mergeRandomWithCorrectAnswers($randomAnswer->answer);
        }

        return response()->json($randomAnswers);
    }

    // if there are incorrect answers attached to the answer id, retrieve the list of incorrect answers
    public function getIncorrectAnswers($answerId, $categoryAnswer)
    {
        $incorrectAnswersArray = [];
        $incorrectAnswers = IncorrectAnswer::where('answer_id', $answerId)->get()->toArray();

        if (count($incorrectAnswers) > 0) {
            $incorrectAnswersArray = [$categoryAnswer];
            foreach ($incorrectAnswers as $incorrectAnswer) {
                $incorrectAnswersArray[] = $incorrectAnswer['incorrect_answer'];
            }
        }
        // shuffle($incorrectAnswersArray);

        return $incorrectAnswersArray;
    }

    // if there are no incorrect answers attached to the answer id, retrieve random answers:
    public function mergeRandomWithCorrectAnswers(string $answer)
    {
        // pick three random answers that is not the correct answer, and add the correct answer to this array, shuffle the positions so this will be randomized.
        return Answer::pluck('answer')->whereNotIn('answer', $answer)->random(3)->push($answer)->shuffle();
    }
}
