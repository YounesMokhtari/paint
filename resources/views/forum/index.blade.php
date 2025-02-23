<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-r from-sage-50 to-rose-50 py-16">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl font-bold text-gray-900 mb-4 text-center">
                    {{ __('forum.index.title') }}
                </h1>
                <p class="text-xl text-gray-600 text-center mb-8">
                    {{ __('forum.index.subtitle') }}
                </p>
                <div class="flex justify-center">
                    <a href="{{ route('forum-topics.create') }}"
                        class="inline-flex items-center px-6 py-3 bg-sage-500 text-white text-base font-medium rounded-lg hover:bg-sage-600 transition duration-200">
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        {{ __('forum.index.create_new') }}
                    </a>
                </div>

                <!-- Filters -->
                <div class="mt-8 bg-white p-4 rounded-xl shadow-sm">
                    <form action="{{ route('forum-topics.index') }}" method="GET"
                        class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <select name="category"
                            class="rounded-lg border-gray-300 focus:border-sage-500 focus:ring-sage-500">
                            <option value="">{{ __('forum.index.filter_category') }}</option>
                            @foreach (['general', 'help', 'discussion', 'feedback'] as $category)
                                <option value="{{ $category }}" @selected(request('category') == $category)>
                                    {{ __("forum.categories.$category") }}
                                </option>
                            @endforeach
                        </select>

                        <x-search-box :placeholder="__('forum.index.search')" />

                        <button type="submit"
                            class="bg-sage-600 text-white px-6 py-2 rounded-lg hover:bg-sage-700 transition-colors">
                            {{ __('common.apply_filters') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Topics List -->
        <div class="container mx-auto px-4 py-12">
            <div class="space-y-6">
                @forelse($forumTopics as $topic)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div class="flex-grow">
                                    <h3 class="text-xl font-semibold mb-2">
                                        <a href="{{ route('forum-topics.show', $topic) }}"
                                            class="text-gray-900 hover:text-sage-600 transition-colors">
                                            {{ $topic->title }}
                                        </a>
                                    </h3>
                                    <div class="flex flex-wrap items-center text-sm text-gray-500 gap-3">
                                        <div class="flex items-center">
                                            <img src="{{ $topic->user->profile_photo }}"
                                                alt="{{ $topic->user->username }}" class="w-6 h-6 rounded-full mr-2">
                                            <span>{{ $topic->user->username }}</span>
                                        </div>
                                        <span class="text-gray-300">•</span>
                                        <span>{{ $topic->formatted_created_at }}</span>
                                        <span class="text-gray-300">•</span>
                                        <span>{{ trans_choice('forum.topics.replies', $topic->replies_count, ['count' => $topic->replies_count]) }}</span>
                                    </div>
                                </div>

                                @if ($topic->lastreply)
                                    <div class="text-sm text-gray-500 text-right rtl:text-left">
                                        <div class="font-medium text-sage-600">{{ __('forum.topics.last_reply') }}
                                        </div>
                                        <div>{{ $topic->lastreply->formatted_created_at }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <p class="mt-4 text-gray-500">{{ __('forum.index.no_topics') }}</p>
                        <a href="{{ route('forum-topics.create') }}"
                            class="mt-4 inline-flex items-center text-sage-500 hover:text-sage-600">
                            {{ __('forum.index.create_first') }}
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
                {{ $forumTopics->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
