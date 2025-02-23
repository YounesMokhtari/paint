<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Courses\Course;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(string $slug): View
    {
        $courses = Course::query()
            ->whereIn('category_id', Category::where('slug', $slug)->select('id'))
            ->paginate(12);

        return view('categories.show', [
            'category' => ucfirst($slug),
            'courses' => $courses
        ]);
    }
}
