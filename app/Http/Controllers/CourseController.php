<?php

namespace App\Http\Controllers;

use App\Models\Courses\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('viewAny', Course::class);

        $categories = Category::all();
        $levels = ['beginner', 'intermediate', 'advanced'];

        $courses = Course::query()
            ->with(['creator', 'category'])
            ->when($request->category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->when($request->level, function ($query, $level) {
                return $query->where('level', $level);
            })
            ->when($request->sort, function ($query, $sort) {
                return match ($sort) {
                    'popular' => $query->orderByDesc('students_count'),
                    'price_asc' => $query->orderBy('price'),
                    'price_desc' => $query->orderByDesc('price'),
                    default => $query->latest()
                };
            }, fn($query) => $query->latest())
            ->paginate(12)
            ->withQueryString();

        return view('courses.index', compact('courses', 'categories', 'levels'));
    }

    public function create(): View
    {
        $this->authorize('create', Course::class);

        $categories = Category::all();
        $levels = ['beginner', 'intermediate', 'advanced'];

        return view('courses.create', compact('categories', 'levels'));
    }

    public function store(StoreCourseRequest $request)
    {
        $this->authorize('create', Course::class);

        // try {
        $data = $request->validated();
        if ($request->hasFile('poster')) {
            $path = Storage::put('course-posters', $request->file('poster'));
            $data['poster'] = Storage::url($path);
        }

        $data['creator_id'] = Auth::id();
        $data['slug'] = \Str::slug($data['title']);

        Course::create($data);

        return redirect()
            ->route('courses.index')
            ->with('success', __('courses.messages.created_successfully'));
        // } catch (\Exception $e) {
        //     return back()
        //         ->withInput()
        //         ->withErrors(['error' => __('courses.messages.create_failed')]);
        // }
    }

    public function show(Course $course): View
    {
        $this->authorize('view', $course);

        $course->load(['creator', 'category', 'lessons', 'reviews.user']);

        $relatedCourses = Course::query()
            ->where('category_id', $course->category_id)
            ->where('id', '!=', $course->id)
            ->take(3)
            ->get();

        return view('courses.show', compact('course', 'relatedCourses'));
    }

    public function edit(Course $course): View
    {
        $this->authorize('update', $course);

        $categories = Category::all();
        $levels = ['beginner', 'intermediate', 'advanced'];

        return view('courses.edit', compact('course', 'categories', 'levels'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $this->authorize('update', $course);

        try {
            $data = $request->validated();

            if ($request->hasFile('poster')) {
                // حذف تصویر قبلی
                if ($course->poster) {
                    Storage::delete(str_replace('/storage', 'public', $course->poster));
                }

                $path = Storage::put('course-posters', $request->file('poster'));
                $data['poster'] = Storage::url($path);
            }

            $data['slug'] = \Str::slug($data['title']);
            $course->update($data);

            return redirect()
                ->route('courses.show', $course)
                ->with('success', __('courses.messages.updated_successfully'));
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => __('courses.messages.update_failed')]);
        }
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);

        try {
            // حذف تصویر دوره
            if ($course->poster) {
                Storage::delete(str_replace('/storage', 'public', $course->poster));
            }

            $course->delete();

            return redirect()
                ->route('courses.index')
                ->with('success', __('courses.messages.deleted_successfully'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => __('courses.messages.delete_failed')]);
        }
    }
}
