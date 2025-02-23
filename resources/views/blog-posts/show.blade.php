<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <article class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <!-- Article Header -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h1 class="text-3xl font-serif font-bold text-gray-900 dark:text-gray-100 mb-4">
                        {{ $blogPost->title }}
                    </h1>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $blogPost->author->profile_photo }}" alt="{{ $blogPost->author->name }}"
                                class="w-10 h-10 rounded-full ring-2 ring-sage-500">
                            <div>
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $blogPost->author->name }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $blogPost->created_at->format('Y/m/d H:i') }}
                                </div>
                            </div>
                        </div>

                        @if (auth()->id() === $blogPost->author_id)
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('blog-posts.edit', $blogPost) }}"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-sage-600 hover:text-sage-700 dark:text-sage-400 dark:hover:text-sage-300 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    {{ __('blog-posts.show.edit_post') }}
                                </a>
                                <form action="{{ route('blog-posts.destroy', $blogPost) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('{{ __('blog-posts.index.delete_confirm') }}')"
                                        class="inline-flex items-center text-red-500 hover:text-red-600 dark:text-red-400">
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        {{ __('blog-posts.show.delete_post') }}
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Article Content -->
                <div class="p-6">
                    <div class="prose prose-sage max-w-none dark:prose-invert">
                        {!! nl2br(e($blogPost->content)) !!}
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="p-6 bg-gray-50 dark:bg-gray-900/50">
                    <h3 class="text-2xl font-serif mb-6 text-gray-800 dark:text-gray-200">
                        {{ __('blog-posts.show.comments') }}
                    </h3>

                    @auth
                        <div class="mb-8">
                            @include('comments._form', ['blog_post_id' => $blogPost->id, 'type' => 'blog'])
                        </div>
                    @endauth

                    @if ($blogPost->comments->count() > 0)
                        <div class="space-y-6">
                            @foreach ($blogPost->comments as $comment)
                                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center">
                                            <img src="{{ $comment->user->profile_photo }}"
                                                alt="{{ $comment->user->name }}" class="w-8 h-8 rounded-full">
                                            <div class="mr-4">
                                                <div class="font-medium text-gray-800 dark:text-gray-200">
                                                    {{ $comment->user->name }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-4 text-gray-600 dark:text-gray-300">
                                        {{ $comment->content }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400 text-center py-8">
                            {{ __('blog-posts.show.no_comments') }}
                        </p>
                    @endif
                </div>
            </article>
        </div>
    </div>
</x-app-layout>
