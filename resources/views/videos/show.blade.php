<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold">{{ $video->title }}</h2>
                        <a href="{{ route('videos.index') }}" class="text-gray-600 hover:text-primary-500 transition">
                            {{ __('videos.actions.back') }}
                        </a>
                    </div>

                    <!-- Video Player -->
                    <div class="mb-8">
                        <div class="aspect-w-16 aspect-h-9 bg-black rounded-lg overflow-hidden">
                            <video id="videoPlayer" class="w-full h-full" controls controlsList="nodownload"
                                poster="{{ $video->thumbnail_url ?? '' }}">
                                <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                                {{ __('videos.browser_not_supported') }}
                            </video>
                        </div>
                    </div>

                    <!-- Video Info -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-medium mb-2">{{ __('videos.forms.description') }}</h3>
                            <p class="text-gray-600">{{ $video->description }}</p>
                        </div>

                        <div class="flex items-center text-sm text-gray-500">
                            <span>{{ trans_choice('videos.duration', $video->duration, ['count' => $video->duration]) }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $video->created_at->format('Y/m/d') }}</span>
                        </div>

                        @if ($video->isOwnedBy(auth()->user()))
                            <div class="flex gap-4">
                                <a href="{{ route('videos.edit', $video) }}"
                                    class="text-primary-600 hover:text-primary-700">
                                    {{ __('videos.edit') }}
                                </a>
                                <form action="{{ route('videos.destroy', $video) }}" method="POST"
                                    onsubmit="return confirm('{{ __('videos.confirm_delete') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700">
                                        {{ __('videos.delete') }}
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const video = document.getElementById('videoPlayer');

                // اضافه کردن کنترل‌های اضافی
                video.addEventListener('contextmenu', function(e) {
                    e.preventDefault(); // جلوگیری از منوی راست کلیک
                });

                // بهبود عملکرد پخش
                video.addEventListener('loadedmetadata', function() {
                    console.log('Video metadata loaded');
                });

                video.addEventListener('error', function(e) {
                    console.error('Video error:', e);
                });
            });
        </script>
    @endpush
</x-app-layout>
