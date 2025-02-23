<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-8">
                        <h2 class="text-3xl font-serif mb-2">{{ $artWork->title }}</h2>
                        <div class="flex items-center text-sage-500 mb-4">
                            <span>{{ __('art-works.show.by') }} {{ $artWork->user->name }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $artWork->created_at->format('Y/m/d') }}</span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <img src="{{ asset($artWork->image) }}" alt="{{ $artWork->title }}"
                            class="w-full rounded-lg shadow-lg">
                    </div>

                    <div class="prose max-w-none mb-8">
                        <p>{{ $artWork->description }}</p>
                    </div>

                    @auth
                        <div class="mt-8">
                            <h3 class="text-xl font-bold mb-4">{{ __('art-works.show.add_comment') }}</h3>
                            @include('comments._form', ['art_work_id' => $artWork->id])
                        </div>
                    @endauth

                    @if ($artWork->comments->count() > 0)
                        <div class="mt-8">
                            <h3 class="text-xl font-bold mb-4">{{ __('art-works.show.comments') }}</h3>
                            @foreach ($artWork->comments as $comment)
                                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium">{{ $comment->user->name }}</p>
                                            <p class="text-sm text-gray-500">
                                                {{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <p class="mt-2">{{ $comment->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 mt-4">{{ __('art-works.show.no_comments') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
