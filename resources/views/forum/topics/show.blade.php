<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="py-12">
            <div class="container mx-auto px-4">
                <!-- Topic Section -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $topic->title }}</h1>
                                <div class="flex flex-wrap items-center text-sm text-gray-500 gap-3">
                                    <div class="flex items-center">
                                        <img src="{{ $topic->user->profile_photo }}"
                                            alt="{{ $topic->user->username }}" class="w-6 h-6 rounded-full mr-2">
                                        <span>{{ __('forum.topics.created_by') }} {{ $topic->user->username }}</span>
                                    </div>
                                    <span class="text-gray-300">•</span>
                                    <span>{{ $topic->formatted_created_at }}</span>
                                </div>
                            </div>
                            <a href="{{ route('forum-topics.index') }}"
                                class="text-gray-600 hover:text-sage-500 transition">
                                {{ __('forum.actions.back') }}
                            </a>
                        </div>

                        <!-- Topic Content -->
                        <div class="prose max-w-none mb-6">
                            {{ $topic->content }}
                        </div>

                        @if ($topic->isOwnedBy(auth()->user()))
                            <div class="flex gap-4 pt-4 border-t border-gray-100">
                                <a href="{{ route('forum-topics.edit', $topic) }}"
                                    class="text-sage-600 hover:text-sage-700 transition-colors">
                                    {{ __('forum.topics.edit') }}
                                </a>
                                <form action="{{ route('forum-topics.destroy', $topic) }}" method="POST"
                                    onsubmit="return confirm('{{ __('forum.topics.confirm_delete') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700 transition-colors">
                                        {{ __('forum.topics.delete') }}
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Replies Section -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-8">
                            {{ trans_choice('forum.topics.replies', $topic->replies_count, ['count' => $topic->replies_count]) }}
                        </h2>

                        <!-- Replies List -->
                        <div class="space-y-8">
                            @forelse($topic->replies as $reply)
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                            <img src="{{ $reply->user->profile_photo }}"
                                                alt="{{ $reply->user->username }}"
                                                class="w-10 h-10 rounded-full object-cover">
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $reply->user->username }}
                                                </div>
                                                <div class="text-sm text-gray-500">{{ $reply->formatted_created_at }}
                                                </div>
                                            </div>
                                        </div>
                                        @if ($reply->isOwnedBy(auth()->user()))
                                            <div class="flex gap-4">
                                                <a href="{{ route('forum-replies.edit', $reply) }}"
                                                    class="text-sage-600 hover:text-sage-700 transition-colors">
                                                    {{ __('forum.replies.edit') }}
                                                </a>
                                                <form action="{{ route('forum-replies.destroy', $reply) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ __('forum.replies.confirm_delete') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-700 transition-colors">
                                                        {{ __('forum.replies.delete') }}
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="prose max-w-none">
                                        {{ $reply->content }}
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-8">{{ __('forum.topics.no_replies') }}</p>
                            @endforelse
                        </div>

                        <!-- Reply Form -->
                        <div class="mt-8 pt-8 border-t border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">{{ __('forum.replies.your_reply') }}</h3>
                            <form action="{{ route('forum-replies.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="topic_id" value="{{ $topic->id }}">

                                <div>
                                    <textarea name="content" rows="4"
                                        class="block w-full rounded-lg border-gray-300 focus:border-sage-500 focus:ring-sage-500
                                               dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300
                                               transition-all duration-200"
                                        placeholder="{{ __('forum.forms.content_placeholder') }}" required>{{ old('content') }}</textarea>
                                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                </div>

                                <div class="flex justify-end">
                                    <x-primary-button class="bg-sage-600 hover:bg-sage-700">
                                        {{ __('forum.replies.post_reply') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
