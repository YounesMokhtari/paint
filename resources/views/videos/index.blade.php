<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">{{ __('videos.title') }}</h2>
                        <a href="{{ route('videos.create') }}"
                            class="bg-primary-500 text-white px-4 py-2 rounded-md hover:bg-primary-600 transition">
                            {{ __('videos.upload') }}
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($videos as $video)
                            <div
                                class="bg-white rounded-lg shadow-lg overflow-hidden border hover:border-primary-300 transition">
                                <div class="aspect-w-16 aspect-h-9">
                                    <iframe src="{{ $video->video_url }}" class="w-full h-full" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold mb-2 text-gray-900 hover:text-primary-600">{{ $video->title }}
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($video->description, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-500 text-sm">
                                            {{ trans_choice('videos.duration', $video->duration, ['count' => $video->duration]) }}
                                        </span>
                                        <a href="{{ route('videos.show', $video) }}"
                                            class="text-primary-500 hover:text-primary-600 font-medium">
                                            {{ __('videos.watch') }} →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $videos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
