<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-3xl font-serif text-center mb-12">{{ ucfirst($category) }} Courses</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($courses as $course)
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                <img src="{{ asset($course->image_url ?? 'assets/images/courses/default.jpg') }}"
                                    alt="{{ $course->title }}" class="w-full h-48 object-cover">
                                <div class="p-6">
                                    <h3 class="text-xl font-serif mb-2">{{ $course->title }}</h3>
                                    <p class="text-sage-600 mb-4">{{ Str::limit($course->description, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sage-500">By {{ $course->creator->username }}</span>
                                        <a href="{{ route('courses.show', $course) }}"
                                            class="text-sage-500 hover:text-sage-600">
                                            Learn more →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
