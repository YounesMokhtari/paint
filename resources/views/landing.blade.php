<x-app-layout>

<!-- صفحه اصلی -->
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="relative h-[80vh] bg-gradient-to-r from-purple-50 to-rose-50">
        <div class="absolute inset-0 bg-pattern opacity-10"></div>
        <div class="container mx-auto px-4 h-full flex items-center">
            <div class="max-w-2xl">
                <h1 class="text-5xl font-bold text-gray-900 mb-6">
                    {{ __('landing.hero.title') }}
                </h1>
                <p class="text-xl text-gray-600 mb-8">
                    {{ __('landing.hero.description') }}
                </p>

                <!-- Search Box -->
                <div class="relative">
                    <form action="{{ route('search') }}" method="GET">
                        <input type="text" name="q"
                               class="w-full px-6 py-4 rounded-full border-2 border-gray-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all"
                               placeholder="جستجو در دوره‌ها و مطالب آموزشی...">
                        <button type="submit"
                                class="absolute left-2 top-2 bg-purple-600 text-white px-6 py-2 rounded-full hover:bg-purple-700 transition-colors">
                            جستجو
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Courses -->
    <div class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">{{ __('landing.featured_courses.title') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($featuredCourses as $course)
                    <!-- Course Card -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                            <img src="{{ $course->poster }}" alt="{{ $course->title }}" class="object-cover">
                        </div>
                        <div class="p-6">
                            <div class="text-sm text-purple-600 mb-2">{{ $course->category->name }}</div>
                            <h3 class="text-xl font-semibold mb-2">{{ $course->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($course->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-900 font-bold">{{ number_format($course->price) }} تومان</span>
                                <a href="{{ route('courses.show', $course) }}"
                                   class="bg-purple-100 text-purple-700 px-4 py-2 rounded-lg hover:bg-purple-200 transition-colors">
                                    {{ __('landing.featured_courses.learn_more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="bg-white py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">{{ __('landing.categories.title') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($categories as $category)
                    <a href="{{ $category['url'] }}"
                       class="group block bg-gray-50 rounded-xl p-6 hover:bg-purple-50 transition-colors">
                        <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-lg p-3 mb-4">
                            {!! $category['icon_svg'] !!}
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $category['name'] }}</h3>
                        <p class="text-gray-600">{{ $category['description'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Gallery Section -->
    <div class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">{{ __('landing.community.title') }}</h2>
            <p class="text-xl text-gray-600 text-center mb-12">{{ __('landing.community.description') }}</p>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($communityArtworks as $artwork)
                    <div class="relative group">
                        <div class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden">
                            <img src="{{ $artwork->image_url }}"
                                 alt="{{ __('landing.community.artwork_by', ['name' => $artwork->user->name]) }}"
                                 class="object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="text-white text-sm">{{ $artwork->user->name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('forum-topics.index') }}"
                   class="inline-block bg-white text-purple-600 px-8 py-3 rounded-full border-2 border-purple-600 hover:bg-purple-50 transition">
                    {{ __('landing.community.join') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Community Section -->
    <div class="py-16 bg-gradient-to-b from-purple-50 to-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">{{ __('landing.why_choose_us.title') }}</h2>
            <p class="text-xl text-gray-600 text-center mb-12">{{ __('landing.why_choose_us.description') }}</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Expert Instructors -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="w-16 h-16 mb-4 text-purple-600">
                        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">{{ __('landing.why_choose_us.expert_instructors') }}</h3>
                    <p class="text-gray-600">{{ __('landing.why_choose_us.expert_instructors_desc') }}</p>
                </div>

                <!-- Flexible Learning -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="w-16 h-16 mb-4 text-purple-600">
                        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">{{ __('landing.why_choose_us.flexible_learning') }}</h3>
                    <p class="text-gray-600">{{ __('landing.why_choose_us.flexible_learning_desc') }}</p>
                </div>

                <!-- Community Support -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="w-16 h-16 mb-4 text-purple-600">
                        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">{{ __('landing.why_choose_us.community_support') }}</h3>
                    <p class="text-gray-600">{{ __('landing.why_choose_us.community_support_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
