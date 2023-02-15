<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;
use App\Models\QuestionCategory;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        QuestionCategory::factory()->count(12)->create();
        DB::table('answer_types')->insert([['type_name' => 'Select'], ['type_name' => 'Multi select'], ['type_name' => 'Boolean (true or false)']]);
        Answer::factory()->count(12)->create();
        Question::factory()->count(50)->create();
    }
}
