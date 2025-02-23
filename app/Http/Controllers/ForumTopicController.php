<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreForumTopicRequest;
use App\Http\Requests\UpdateForumTopicRequest;
use App\Models\Forum\ForumTopic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ForumTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ForumTopic::query()->with(['user', 'lastreply']);

        // اعمال فیلتر دسته‌بندی
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // اعمال جستجو
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('content', 'like', "%{$searchTerm}%")
                    ->orWhereHas('user', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', "%{$searchTerm}%");
                    })
                    ->orWhereHas('replies', function ($q) use ($searchTerm) {
                        $q->where('content', 'like', "%{$searchTerm}%");
                    });
            });
        }

        $forumTopics = $query->latest()->paginate(15);
        return view('forum.index', compact('forumTopics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(view: 'forum.topics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreForumTopicRequest $request)
    {
        $forumTopic = ForumTopic::create($request->validated() + ['user_id' => Auth::id()]);
        return redirect()->route('forum-topics.index')
            ->with(key: 'success', value: 'Forum topic created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ForumTopic $forumTopic)
    {
        return view('forum.topics.show', ['topic' => $forumTopic->load('replies')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ForumTopic $forumTopic)
    {
        return view('forum.topics.edit', compact('forumTopic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateForumTopicRequest $request, ForumTopic $forumTopic)
    {
        $forumTopic->update($request->validated());
        return redirect()->route('forum-topics.index')->with('success', 'Forum topic updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ForumTopic $forumTopic)
    {
        $forumTopic->delete();
        return redirect()->route('forum-topics.index')->with('success', 'Forum topic deleted successfully');
    }
}
