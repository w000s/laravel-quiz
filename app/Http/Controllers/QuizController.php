<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class QuizController extends Controller
{
    /**
     * Store a new question.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    // Eerst answer validaten en createn, vervolgens deze id gebruiken in Question

    public function createQuestionAndAnswer(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'question' => 'required',
                'question_category_id' => 'required',
                'answer' => 'required',
                'answer_type_id' => 'required'
            ],
            [
                'question.required' => 'Question is a required field',
                'question_category_id.required' => 'Question category is a required field',
                'answer.required' => 'Answer is a required field',
                'answer_type_id.required' => 'Answer type is a required field'
            ]
        );

        if ($validator->fails()) {
            throw ValidationException::withMessages(['errors' => $validator->errors()->all()]);
        }

        $answer = Answer::create(['answer' => $request->answer, 'answer_type_id' => $request->answer_type_id, 'question_category_id' => $request->question_category_id]);

        Question::create(['question' => $request->question, 'question_category_id' => $request->question_category_id, 'answer_id' => $answer->id]);

        return response()->json(['success' => 'Question created succesfully']);
    }
}
