<?php

namespace Database\Factories;

use App\Models\AnswerType;
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
        $type = AnswerType::all()->pluck('id')->toArray();

        return [
            'question' => fake()->sentence(),
            'answer' => fake()->word(),
            'question_category_id' => fake()->randomElement($category),
            'answer_type_id' => fake()->randomElement($type)
        ];
    }
}
