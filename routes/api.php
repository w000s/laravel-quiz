<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Models\AnswerType;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/create', [QuizController::class, 'createQuestionAndAnswer']);
Route::get('/get-random-questions', [QuestionController::class, 'getRandomQuestions']);
Route::get('/get-questions/{id}', [QuestionController::class, 'getCategoryQuestions']);
Route::get('/get-random-answers', [AnswerController::class, 'getRandomAnswers']);
Route::get('/get-answers/{id}', [AnswerController::class, 'getCategoryAnswers']);
Route::get('/categories', [CategoriesController::class, 'categories']);

Route::get('/answer-types', function () {
    $answerTypes = AnswerType::all();

    return $answerTypes;
});
