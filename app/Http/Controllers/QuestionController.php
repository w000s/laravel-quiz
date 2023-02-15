<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class QuestionController extends Controller
{

    /**
     * Store a new question.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getQuestion($id)
    {
        $questions = Question::where('question_category_id', $id)->get();

        foreach ($questions as $question) {
            $question->answers = $this->mergeRandomWithCorrectAnswers($question->answer);
        }

        return response()->json($questions);
    }

    public function getRandomQuestion()
    {
        $randomQuestions = Question::all()->random(2);

        foreach ($randomQuestions as $question) {
            $question->answers = $this->mergeRandomWithCorrectAnswers($question->answer);
        }

        return response()->json($randomQuestions);
    }

    public function mergeRandomWithCorrectAnswers(string $value)
    {
        // pick three random answers that is not the correct answer, and add the correct answer to this array, shuffle the positions so this will be randomized.
        return Question::pluck('answer')->whereNotIn('answer', $value)->random(3)->push($value)->shuffle();
    }

    public function createQuestion(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'question' => 'required',
                'answer' => 'required',
                'answer_type_id' => 'required',
                'question_category_id' => 'required'
            ],
            [
                'question.required' => 'Question is a required field',
                'answer.required' => 'Answer is a required field',
                'answer_type_id.required' => 'Answer type is a required field',
                'question_category_id.required' => 'Question category is a required field',

            ]
        );

        if ($validator->fails()) {
            throw ValidationException::withMessages(['errors' => $validator->errors()->all()]);
        }

        Question::create($request->all());

        return response()->json(['success' => 'Question created succesfully']);
    }
}
