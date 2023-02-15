<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\QuestionCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category = QuestionCategory::all()->pluck('id')->toArray();
        $answer = Answer::all()->pluck('id')->toArray();

        return [
            'question' => fake()->sentence(),
            'question_category_id' => fake()->randomElement($category),
            'answer_id' => fake()->randomElement($answer)
        ];
    }
}
