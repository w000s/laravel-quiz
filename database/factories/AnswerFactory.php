<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AnswerType;
use App\Models\QuestionCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = AnswerType::all()->pluck('id')->toArray();
        $category = QuestionCategory::all()->pluck('id')->toArray();

        return [
            'answer' => fake()->sentence(),
            'answer_type_id' => fake()->randomElement($type),
            'question_category_id' => fake()->randomElement($category),

        ];
    }
}
