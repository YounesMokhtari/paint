<?php

namespace App\Http\Controllers;

use App\Models\Courses\Course;
use App\Models\ArtWorks\ArtWork;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $query = $request->get('q');
        $category = $request->get('category');
        $level = $request->get('level');

        $courses = Course::query()
            ->when($query, function ($q) use ($query) {
                return $q->where('title', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            })
            ->when($category, function ($q) use ($category) {
                return $q->where('category', $category);
            })
            ->when($level, function ($q) use ($level) {
                return $q->where('level', $level);
            })
            ->with('creator')
            ->latest()
            ->paginate(9);

        $artworks = ArtWork::query()
            ->when($query, function ($q) use ($query) {
                return $q->where('title', 'like', "%{$query}%");
            })
            ->with('user')
            ->latest()
            ->take(8)
            ->get();

        return view('search.index', compact('courses', 'artworks', 'query', 'category', 'level'));
    }
}
