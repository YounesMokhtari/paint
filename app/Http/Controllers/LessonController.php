<?php

namespace App\Http\Controllers;

use App\Models\Courses\Course;
use App\Models\Lessons\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'video' => ['required', 'file', 'mimetypes:video/*', 'max:512000'], // 500MB
            'duration' => ['required', 'numeric', 'min:0'],
            'is_preview' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        try {
            $path = Storage::put('course-videos', $request->file('video'));

            $lesson = new Lesson([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'video_url' => Storage::url($path),
                'duration' => $validated['duration'],
                'is_preview' => $validated['is_preview'] ?? false,
                'sort_order' => $validated['sort_order'] ?? $course->lessons()->count(),
            ]);

            $course->lessons()->save($lesson);

            return redirect()
                ->route('courses.show', $course)
                ->with('success', __('courses.messages.lesson_added'));
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => __('courses.messages.lesson_add_failed')]);
        }
    }

    public function destroy(Course $course, Lesson $lesson)
    {
        $this->authorize('update', $course);

        try {
            if ($lesson->video_url) {
                Storage::delete(str_replace('/storage', 'public', $lesson->video_url));
            }

            $lesson->delete();

            return redirect()
                ->route('courses.show', $course)
                ->with('success', __('courses.messages.lesson_deleted'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => __('courses.messages.lesson_delete_failed')]);
        }
    }

    public function updateOrder(Course $course, Request $request)
    {
        $this->authorize('update', $course);

        $request->validate([
            'lessons' => ['required', 'array'],
            'lessons.*.id' => ['required', 'exists:lessons,id'],
            'lessons.*.sort_order' => ['required', 'integer', 'min:0'],
        ]);

        foreach ($request->lessons as $lessonData) {
            $course->lessons()
                ->where('id', $lessonData['id'])
                ->update(['sort_order' => $lessonData['sort_order']]);
        }

        return response()->json(['message' => __('courses.messages.lesson_order_updated')]);
    }

    public function edit(Course $course, Lesson $lesson)
    {
        $this->authorize('update', $course);
        return response()->json($lesson);
    }

    public function update(Request $request, Course $course, Lesson $lesson)
    {
        $this->authorize('update', $course);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'video' => ['nullable', 'file', 'mimetypes:video/*', 'max:512000'],
            'duration' => ['required', 'numeric', 'min:0'],
            'is_preview' => ['boolean'],
        ]);

        try {
            if ($request->hasFile('video')) {
                if ($lesson->video_url) {
                    Storage::delete(str_replace('/storage', 'public', $lesson->video_url));
                }
                $path = Storage::put('course-videos', $request->file('video'));
                $validated['video_url'] = Storage::url($path);
            }

            $lesson->update($validated);

            return redirect()
                ->route('courses.show', $course)
                ->with('success', __('courses.messages.lesson_updated'));
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => __('courses.messages.lesson_update_failed')]);
        }
    }
}
