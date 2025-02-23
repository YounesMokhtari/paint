<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPostRequest;
use App\Http\Requests\UpdateBlogPostRequest;
use App\Models\BlogPosts\BlogPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BlogPost::query()->with('author');

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
                    ->orWhereHas('author', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        $blogPosts = $query->latest()->paginate(12)->withQueryString();
        return view('blog-posts.index', compact('blogPosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog-posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogPostRequest $request)
    {
        $blogPost = BlogPost::create($request->validated() + ['author_id' => Auth::id()]);
        return redirect()->route('blog-posts.index')->with('success', 'Blog post created successfully');
    }


    public function show(BlogPost $blogPost)
    {
        $blogPost->load('comments.user');
        return view('blog-posts.show', compact('blogPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blogPost)
    {
        return view('blog-posts.edit', compact('blogPost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogPostRequest $request, BlogPost $blogPost)
    {
        $blogPost->update($request->validated());
        return redirect()->route('blog-posts.index')->with('success', 'Blog post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect()->route('blog-posts.index')->with('success', 'Blog post deleted successfully');
    }
}
