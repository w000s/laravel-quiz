<?php

namespace App\Http\Controllers;

use App\Models\QuestionCategory;

class CategoriesController extends Controller
{
    public function categories()
    {
        $categories = QuestionCategory::all();

        return response()->json($categories);
    }
}
