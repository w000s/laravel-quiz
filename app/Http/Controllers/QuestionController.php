<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
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
        Question::create($request->all());

        return response()->json(['success' => 'Question created succesfully']);
    }
}
