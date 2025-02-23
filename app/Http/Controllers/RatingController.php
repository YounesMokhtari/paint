<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
            'rateable_id' => 'required|integer',
            'rateable_type' => 'required|string',
        ]);

        $rating = auth()->user()->ratings()->create([
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'rateable_id' => $validated['rateable_id'],
            'rateable_type' => $validated['rateable_type']
        ]);

        return back()->with('success', __('ratings.messages.created'));
    }
}
