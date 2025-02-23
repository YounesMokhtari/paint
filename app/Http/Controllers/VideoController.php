<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Videos\Video;
use App\Models\Videos\VideoFields;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::paginate(10);
        return view('videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoRequest $request)
    {
        $validated = $request->validated();
        $videoPath = Storage::putFileAs('course-videos', $request->file(VideoFields::VIDEO), $request->file(VideoFields::VIDEO)->getClientOriginalName());
        $videoUrl = Storage::url($videoPath);
        $validated[VideoFields::VIDEO] = $videoUrl;
        $video = Video::create($validated);
        Session::flash('status', 'success');
        Session::flash('message', __('successfully stored course'));
        return redirect()->intended(route('courses.show', $request->course_id))->with('success', 'Video created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        return view('videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        return view('videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoRequest $request, Video $video)
    {
        $video->update($request->validated());
        return redirect()->route('videos.index')->with('success', 'Video updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video deleted successfully');
    }
}
