<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-r from-purple-50 to-rose-50 py-16">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl font-bold text-gray-900 mb-4 text-center">
                    {{ __('courses.title') }}
                </h1>
                <p class="text-xl text-gray-600 text-center mb-8">
                    {{ __('courses.description') }}
                </p>
                <a href="{{ route('courses.create') }}"
                class="inline-flex items-center px-6 py-3 bg-sage-500 text-white text-base font-medium rounded-lg hover:bg-sage-600 transition duration-200">
                <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4"></path>
                </svg>
                {{ __('courses.create_new_course') }}
                </a>
                <!-- Filters -->
                <div class="bg-white p-4 rounded-xl shadow-sm">

                    <form action="{{ route('courses.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <select name="category" class="rounded-lg border-gray-200">
                            <option value="">{{ __('courses.all_categories') }}</option>
                            @foreach($categories??[] as $category)
                                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <select name="level" class="rounded-lg border-gray-200">
                            <option value="">{{ __('courses.all_levels') }}</option>
                            @foreach($levels ??[] as $level)
                                <option value="{{ $level }}" @selected(request('level') == $level)>
                                    {{ __("courses.levels.$level") }}
                                </option>
                            @endforeach
                        </select>

                        <select name="sort" class="rounded-lg border-gray-200">
                            <option value="latest" @selected(request('sort') == 'latest')>
                                {{ __('courses.sort_latest') }}
                            </option>
                            <option value="popular" @selected(request('sort') == 'popular')>
                                {{ __('courses.sort_popular') }}
                            </option>
                            <option value="price_asc" @selected(request('sort') == 'price_asc')>
                                {{ __('courses.sort_price_asc') }}
                            </option>
                            <option value="price_desc" @selected(request('sort') == 'price_desc')>
                                {{ __('courses.sort_price_desc') }}
                            </option>
                        </select>

                        <button type="submit"
                                class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                            {{ __('courses.apply_filters') }}
                        </button>
                    </form>
                </div>

            </div>
        </div>

        <!-- Courses Grid -->
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($courses as $course)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                            <img src="{{ $course->poster }}" alt="{{ $course->title }}" class="object-cover">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-purple-600">{{ $course->category->name }}</span>
                                <span class="text-sm text-gray-500">
                                    {{ __("courses.levels.{$course->level}") }}
                                </span>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">{{ $course->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($course->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2 space-x-reverse">
                                    <img src="{{ $course->creator->profile_photo }}"
                                         alt="{{ $course->creator->name }}"
                                         class="w-8 h-8 rounded-full">
                                    <span class="text-sm text-gray-600">{{ $course->creator->name }}</span>
                                </div>
                                <span class="text-lg font-bold text-gray-900">
                                    {{ number_format($course->price) }} تومان
                                </span>
                            </div>
                            <a href="{{ route('courses.show', $course) }}"
                               class="mt-4 block w-full text-center bg-purple-100 text-purple-700 px-4 py-2 rounded-lg hover:bg-purple-200 transition-colors">
                                {{ __('courses.view_course') }}
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500">{{ __('courses.no_courses_found') }}</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
