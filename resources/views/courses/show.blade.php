<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Course Header -->
        <div class="relative bg-gradient-to-r from-purple-50 to-rose-50 py-16">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">
                            {{ $course->title }}
                        </h1>
                        <p class="text-xl text-gray-600 mb-6">
                            {{ $course->description }}
                        </p>
                        <div class="flex items-center space-x-4 space-x-reverse mb-8">
                            <span class="px-3 py-1 text-sm rounded-full bg-purple-100 text-purple-800">
                                {{ $course->category->name }}
                            </span>
                            <span class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-800">
                                {{ __("courses.levels.{$course->level}") }}
                            </span>
                        </div>
                        <div class="flex items-center space-x-4 space-x-reverse">
                            <img src="{{ $course->creator->profile_photo }}" alt="{{ $course->creator->name }}"
                                class="w-12 h-12 rounded-full">
                            <div>
                                <p class="font-medium text-gray-900">{{ $course->creator->name }}</p>
                                <p class="text-sm text-gray-600">{{ __('courses.course_instructor') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <img src="{{ $course->poster }}" alt="{{ $course->title }}" class="rounded-xl shadow-lg w-full">
                        @if ($course->is_featured)
                            <span
                                class="absolute top-4 right-4 px-4 py-2 bg-purple-600 text-white rounded-full text-sm">
                                {{ __('courses.featured') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Content -->
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Course Lessons -->
                    <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">{{ __('courses.course_content') }}</h2>
                            @can('update', $course)
                                <button onclick="openLessonModal()"
                                    class="inline-flex items-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700">
                                    <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    {{ __('courses.lessons.add') }}
                                </button>
                            @endcan
                        </div>
                        <div class="space-y-4">
                            @forelse($course->lessons as $lesson)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center space-x-4 space-x-reverse">
                                        <span
                                            class="w-8 h-8 flex items-center justify-center bg-purple-100 text-purple-600 rounded-full">
                                            {{ $loop->iteration }}
                                        </span>
                                        <div>
                                            <h3 class="font-medium text-gray-900">{{ $lesson->title }}</h3>
                                            <p class="text-sm text-gray-600">{{ $lesson->duration }}
                                                {{ __('courses.minutes') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2 space-x-reverse">
                                        @can('update', $course)
                                            <button onclick="editLesson({{ $lesson->id }})"
                                                class="text-gray-600 hover:text-gray-800">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <form action="{{ route('courses.lessons.destroy', [$course, $lesson]) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('{{ __('courses.lessons.confirm_delete') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endcan
                                        <button
                                            onclick="playVideo('{{ $lesson->video_url }}', '{{ $lesson->title }}')"
                                            class="text-purple-600 hover:text-purple-700">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-600 text-center py-4">{{ __('courses.no_lessons') }}</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Course Reviews -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">{{ __('courses.student_reviews') }}</h2>
                            @auth
                                <button onclick="openReviewModal()"
                                    class="inline-flex items-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700">
                                    <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    {{ __('courses.reviews.add') }}
                                </button>
                            @endauth
                        </div>

                        <!-- Average Rating -->
                        <div class="flex items-center mb-8">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <span
                                        class="text-3xl font-bold text-gray-900 ml-2">{{ number_format($course->average_rating, 1) }}</span>
                                    <div class="flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-6 h-6 {{ $i <= round($course->average_rating) ? 'text-yellow-400' : 'text-gray-300' }}"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-gray-600">
                                    {{ __('courses.reviews.based_on', ['count' => $course->reviews_count]) }}</p>
                            </div>

                            <!-- Rating Distribution -->
                            <div class="w-64">
                                @foreach (range(5, 1) as $rating)
                                    <div class="flex items-center mb-1">
                                        <span class="text-sm text-gray-600 w-3">{{ $rating }}</span>
                                        <div class="flex-1 h-2 mx-2 bg-gray-200 rounded">
                                            @php
                                                $percentage =
                                                    $course->reviews_count > 0
                                                        ? ($course->reviews->where('rating', $rating)->count() /
                                                                $course->reviews_count) *
                                                            100
                                                        : 0;
                                            @endphp
                                            <div class="h-full bg-yellow-400 rounded"
                                                style="width: {{ $percentage }}%"></div>
                                        </div>
                                        <span
                                            class="text-sm text-gray-600 w-8">{{ number_format($percentage) }}%</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Reviews List -->
                        <div class="space-y-6">
                            @forelse($course->reviews()->latest()->get() as $review)
                                <div class="border-b border-gray-200 pb-6 last:border-0">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center space-x-4 space-x-reverse">
                                            <img src="{{ $review->user->profile_photo }}"
                                                alt="{{ $review->user->name }}" class="w-10 h-10 rounded-full">
                                            <div>
                                                <h4 class="font-medium text-gray-900">{{ $review->user->name }}</h4>
                                                <p class="text-sm text-gray-600">{{ $review->formatted_date }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-gray-600">{{ $review->comment }}</p>
                                </div>
                            @empty
                                <p class="text-gray-600 text-center py-4">{{ __('courses.no_reviews') }}</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm p-6 sticky top-8">
                        <div class="text-3xl font-bold text-gray-900 mb-6">
                            {{ number_format($course->price) }} {{ __('courses.currency') }}
                        </div>
                        <div class="space-y-4 mb-6">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">{{ __('courses.course_details.lessons') }}</span>
                                <span class="font-medium">{{ $course->lessons_count }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">{{ __('courses.course_details.duration') }}</span>
                                <span class="font-medium">{{ $course->total_duration }}
                                    {{ __('courses.hours') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">{{ __('courses.course_details.students') }}</span>
                                <span class="font-medium">{{ $course->students_count }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">{{ __('courses.course_details.last_update') }}</span>
                                <span class="font-medium">{{ $course->updated_at->format('Y/m/d') }}</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            @if (auth()->check())
                                @if ($course->students()->where('users.id', auth()->id())->exists())
                                    <!-- دانشجوی دوره -->
                                    <div class="bg-green-100 text-green-800 px-6 py-3 rounded-lg text-center">
                                        {{ __('courses.enrolled_student') }}
                                    </div>
                                @else
                                    <!-- دکمه ثبت‌نام -->
                                    <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                        @csrf
                                        @method('post')
                                        <button type="submit"
                                            class="w-full bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors">
                                            {{ __('courses.course_details.enroll_now') }}
                                            <span class="block text-sm">
                                                {{ number_format($course->price) }} {{ __('courses.currency') }}
                                            </span>
                                        </button>
                                    </form>
                                @endif
                            @else
                                <!-- لینک ورود -->
                                <a href="{{ route('login') }}"
                                    class="block w-full bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors text-center">
                                    {{ __('courses.login_to_enroll') }}
                                </a>
                            @endif

                            @if ($course->has_preview)
                                <button
                                    onclick="playVideo('{{ $course->preview_url }}', '{{ __('courses.preview_title') }}')"
                                    class="w-full bg-purple-100 text-purple-700 px-6 py-3 rounded-lg hover:bg-purple-200 transition-colors">
                                    {{ __('courses.course_details.preview') }}
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('courses.partials.video-player-modal')
    @can('update', $course)
        @include('courses.partials.lesson-modal')
        @include('courses.partials.edit-lesson-modal')
    @endcan

    <!-- Review Modal -->
    @auth
        <div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-xl mx-4">
                <h3 class="text-lg font-bold mb-4 dark:text-white">{{ __('courses.reviews.add_new') }}</h3>

                <form action="{{ route('courses.reviews.store', $course) }}" method="POST">
                    @csrf

                    <div class="space-y-4">
                        <!-- Rating -->
                        <div>
                            <x-input-label :value="__('courses.reviews.rating')" />
                            <div class="flex items-center space-x-2 space-x-reverse mt-2">
                                @foreach (range(5, 1) as $rating)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="rating" value="{{ $rating }}"
                                            class="hidden peer" required>
                                        <svg class="w-8 h-8 text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                        </div>

                        <!-- Comment -->
                        <div>
                            <x-input-label for="comment" :value="__('courses.reviews.comment')" />
                            <textarea id="comment" name="comment" rows="4" required
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-500 focus:ring-purple-500"></textarea>
                            <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-4">
                        <x-secondary-button type="button" onclick="closeReviewModal()">
                            {{ __('courses.cancel') }}
                        </x-secondary-button>
                        <x-primary-button>
                            {{ __('courses.reviews.submit') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openReviewModal() {
                document.getElementById('reviewModal').classList.remove('hidden');
                document.getElementById('reviewModal').classList.add('flex');
            }

            function closeReviewModal() {
                document.getElementById('reviewModal').classList.remove('flex');
                document.getElementById('reviewModal').classList.add('hidden');
            }
        </script>
    @endauth
</x-app-layout>

<script>
    function playVideo(url, title) {
        const modal = document.getElementById('videoPlayerModal');
        const player = document.getElementById('videoPlayer');
        const titleEl = document.getElementById('videoTitle');

        player.src = url;
        titleEl.textContent = title;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        player.play();
    }

    function closeVideoPlayer() {
        const modal = document.getElementById('videoPlayerModal');
        const player = document.getElementById('videoPlayer');

        player.pause();
        player.src = '';
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>
