<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreForumReplyRequest;
use App\Http\Requests\UpdateForumReplyRequest;
use App\Models\Forum\ForumReply;
use Illuminate\Support\Facades\Auth;

class ForumReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forumReplies = ForumReply::paginate(10);
        return view('forum-replies.index', compact('forumReplies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forum-replies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreForumReplyRequest $request)
    {
        $forumReply = ForumReply::create($request->validated() + ['user_id' => Auth::id()]);
        return redirect()->route('forum-topics.show', $forumReply->topic_id)->with('success', 'Forum reply created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ForumReply $forumReply)
    {
        return view('forum-replies.show', compact('forumReply'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ForumReply $forumReply)
    {
        return view('forum-replies.edit', compact('forumReply'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateForumReplyRequest $request, ForumReply $forumReply)
    {
        $forumReply->update($request->validated());
        return redirect()->route('forum-replies.index')->with('success', 'Forum reply updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ForumReply $forumReply)
    {
        $forumReply->delete();
        return redirect()->route('forum-replies.index')->with('success', 'Forum reply deleted successfully');
    }
}
