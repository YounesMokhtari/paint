<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-r from-sage-50 to-rose-50 py-16">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl font-bold text-gray-900 mb-4 text-center">
                    {{ __('blog-posts.index.title') }}
                </h1>
                <p class="text-xl text-gray-600 text-center mb-8">
                    {{ __('blog-posts.index.subtitle') }}
                </p>
                <div class="flex justify-center">
                    <a href="{{ route('blog-posts.create') }}"
                        class="inline-flex items-center px-6 py-3 bg-sage-500 text-white text-base font-medium rounded-lg hover:bg-sage-600 transition duration-200">
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        {{ __('blog-posts.index.create_new') }}
                    </a>
                </div>

                <!-- Filters -->
                <div class="mt-8 bg-white p-4 rounded-xl shadow-sm">
                    <form action="{{ route('blog-posts.index') }}" method="GET"
                        class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <select name="category"
                            class="rounded-lg border-gray-300 focus:border-sage-500 focus:ring-sage-500">
                            <option value="">{{ __('blog-posts.index.filter_category') }}</option>
                            @foreach (['technology', 'art', 'lifestyle', 'education'] as $category)
                                <option value="{{ $category }}" @selected(request('category') == $category)>
                                    {{ __("blog-posts.categories.$category") }}
                                </option>
                            @endforeach
                        </select>

                        <x-search-box :placeholder="__('blog-posts.index.search')" />

                        <button type="submit"
                            class="bg-sage-600 text-white px-6 py-2 rounded-lg hover:bg-sage-700 transition-colors">
                            {{ __('common.apply_filters') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Blog Posts Grid -->
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($blogPosts as $post)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                @if ($post->category)
                                    <span class="px-3 py-1 text-sm rounded-full bg-sage-100 text-sage-800">
                                        {{ __("blog-posts.categories.{$post->category}") }}
                                    </span>
                                @endif
                                <span class="text-sm text-gray-500">{{ $post->read_time }}
                                    {{ __('blog-posts.index.min_read') }}</span>
                            </div>

                            <h3 class="text-xl font-semibold mb-2 text-gray-900">
                                <a href="{{ route('blog-posts.show', $post) }}" class="hover:text-sage-600">
                                    {{ $post->title }}
                                </a>
                            </h3>

                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $post->content }}</p>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ $post->author->profile_photo }}" alt="{{ $post->author->name }}"
                                        class="w-8 h-8 rounded-full">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $post->author->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $post->formatted_date }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4">
                                    @if (auth()->id() === $post->author_id)
                                        <a href="{{ route('blog-posts.edit', $post) }}"
                                            class="text-gray-400 hover:text-sage-500">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                    @endif
                                    <a href="{{ route('blog-posts.show', $post) }}"
                                        class="text-sage-500 hover:text-sage-600">
                                        {{ __('blog-posts.index.read_more') }} →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        <p class="mt-4 text-gray-500">{{ __('blog-posts.index.no_posts') }}</p>
                        <a href="{{ route('blog-posts.create') }}"
                            class="mt-4 inline-flex items-center text-sage-500 hover:text-sage-600">
                            {{ __('blog-posts.index.create_first') }}
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $blogPosts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
