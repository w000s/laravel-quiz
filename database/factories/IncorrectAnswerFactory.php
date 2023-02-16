<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Answer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class IncorrectAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $answer = Answer::all()->pluck('id')->toArray();

        return [
            'incorrect_answer' => fake()->sentence(),
            'answer_id' => fake()->randomElement($answer)
        ];
    }
}
