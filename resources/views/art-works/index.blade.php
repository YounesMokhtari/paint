<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-r from-sage-50 to-rose-50 py-16">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl font-bold text-gray-900 mb-4 text-center">
                    {{ __('art-works.index.title') }}
                </h1>
                <p class="text-xl text-gray-600 text-center mb-8">
                    {{ __('art-works.index.subtitle') }}
                </p>
                <div class="flex justify-center">
                    <a href="{{ route('art-works.create') }}"
                        class="inline-flex items-center px-6 py-3 bg-sage-500 text-white text-base font-medium rounded-lg hover:bg-sage-600 transition duration-200">
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        {{ __('art-works.index.create_new') }}
                    </a>
                </div>

                <!-- Filters -->
                <div class="mt-8 bg-white p-4 rounded-xl shadow-sm">
                    <form action="{{ route('art-works.index') }}" method="GET"
                        class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <select name="category"
                            class="rounded-lg border-gray-300 focus:border-sage-500 focus:ring-sage-500">
                            <option value="">{{ __('art-works.index.filter_category') }}</option>
                            @foreach (['painting', 'sculpture', 'digital', 'photography'] as $category)
                                <option value="{{ $category }}" @selected(request('category') == $category)>
                                    {{ __("art-works.categories.$category") }}
                                </option>
                            @endforeach
                        </select>

                        <x-search-box :placeholder="__('art-works.index.search')" />

                        <button type="submit"
                            class="bg-sage-600 text-white px-6 py-2 rounded-lg hover:bg-sage-700 transition-colors">
                            {{ __('common.apply_filters') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($artWorks as $artwork)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                            <img src="{{ $artwork->image }}" alt="{{ $artwork->title }}"
                                class="object-cover w-full h-full">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span
                                    class="text-sm text-sage-600">{{ __("art-works.categories.{$artwork->category}") }}</span>
                                <div class="flex space-x-2">
                                    @if (auth()->id() === $artwork->user_id)
                                        <a href="{{ route('art-works.edit', $artwork) }}"
                                            class="text-blue-500 hover:text-blue-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('art-works.destroy', $artwork) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('{{ __('art-works.index.delete_confirm') }}')"
                                                class="text-red-500 hover:text-red-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">{{ $artwork->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($artwork->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                    <img src="{{ $artwork->user->profile_photo }}"
                                        alt="{{ $artwork->user->name }}" class="w-8 h-8 rounded-full">
                                    <span class="text-sm text-gray-600">{{ $artwork->user->name }}</span>
                                </div>
                                <a href="{{ route('art-works.show', $artwork) }}"
                                    class="text-sage-600 hover:text-sage-700">
                                    {{ __('art-works.index.view') }} →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <p class="mt-4 text-gray-500">{{ __('art-works.index.no_artworks') }}</p>
                        <a href="{{ route('art-works.create') }}"
                            class="mt-4 inline-flex items-center text-sage-500 hover:text-sage-600">
                            {{ __('art-works.index.create_first') }}
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
                {{ $artWorks->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
