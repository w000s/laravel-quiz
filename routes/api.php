<?php

use App\Http\Controllers\CategoriesController;
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

Route::post('/create', [QuizController::class, 'createQuestion']);

Route::get('/get-random-question', [QuizController::class, 'getRandomQuestion']);

Route::get('/get-question/{id}', [QuizController::class, 'startQuiz']);

Route::get('/categories', [CategoriesController::class, 'categories']);

Route::get('/answer-types', function () {
    $answerTypes = AnswerType::all();

    return $answerTypes;
});
