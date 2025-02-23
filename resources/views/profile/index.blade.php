<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center space-x-8 mb-8">
                        <div class="relative">
                            @if ($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->username }}"
                                    class="w-32 h-32 rounded-full object-cover">
                            @else
                                <div class="w-32 h-32 rounded-full bg-sage-200 flex items-center justify-center">
                                    <span class="text-4xl text-sage-600">
                                        {{ strtoupper(substr($user->username, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div>
                            <h1 class="text-3xl font-serif mb-2">{{ $user->username }}</h1>
                            <p class="text-sage-600">{{ $user->bio }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- User's Courses --}}
                        <div>
                            <h2 class="text-2xl font-serif mb-4">My Courses</h2>
                            <div class="space-y-4">
                                @foreach ($user->courses as $course)
                                    <div class="bg-white p-4 rounded-lg border">
                                        <h3 class="font-medium mb-2">{{ $course->title }}</h3>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sage-500 text-sm">
                                                {{ $course->videos_count }} videos
                                            </span>
                                            <a href="{{ route('courses.show', $course) }}"
                                                class="text-sage-500 hover:text-sage-600">
                                                View Course →
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- User's Artworks --}}
                        <div>
                            <h2 class="text-2xl font-serif mb-4">My Artworks</h2>
                            <div class="grid grid-cols-2 gap-4">
                                @foreach ($user->artworks as $artwork)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $artwork->image_url) }}"
                                            alt="{{ $artwork->title }}" class="w-full h-48 object-cover rounded-lg">
                                        <div
                                            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-opacity flex items-end p-4">
                                            <div
                                                class="text-white opacity-0 group-hover:opacity-100 transition-opacity">
                                                <h4 class="font-medium">{{ $artwork->title }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
