<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
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

Route::post('/create', [QuestionController::class, 'createQuestion']);

Route::get('/get-random-question', [QuestionController::class, 'getRandomQuestion']);

Route::get('/get-question/{id}', [QuestionController::class, 'getQuestion']);

Route::get('/categories', [CategoriesController::class, 'categories']);

Route::get('/answer-types', function () {
    $answerTypes = AnswerType::all();

    return $answerTypes;
});
