<?php

namespace App\Http\Controllers;

use App\Models\Courses\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request,
                          Course  $course)
    {
        $validated = $request->validate([
            'rating'  => [
                'required',
                'integer',
                'min:1',
                'max:5'
            ],
            'comment' => [
                'required',
                'string',
                'min:10'
            ],
        ]);

        Auth::user()
            ->ratings()
            ->create([
                'rating'        => $validated['rating'],
                'comment'       => $validated['comment'],
                'rateable_id'   => $course->id,
                'rateable_type' => get_class($course),
                'course_id'     => $course->id
            ]);
        try {

        return redirect()
            ->route('courses.show', $course)
            ->with('success', __('courses.messages.review_added'));
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => __('courses.messages.review_add_failed')]);
        }
    }
}
