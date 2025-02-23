@php
    use App\Models\ArtWorks\ArtWorkFields;
@endphp

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-serif text-gray-800 dark:text-gray-200">
                    {{ __('art-works.edit.title') }}
                </h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    {{ __('art-works.edit.subtitle') }}
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="max-w-3xl mx-auto">
                        @if ($errors->any())
                            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative dark:bg-red-900/50 dark:border-red-700 dark:text-red-400"
                                role="alert">
                                <strong class="font-bold">{{ __('art-works.edit.error_title') }}</strong>
                                <ul class="mt-2 list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('art-works.update', $artWork) }}"
                            enctype="multipart/form-data" class="space-y-8">
                            @csrf
                            @method('PUT')

                            <!-- Current Image Preview -->
                            <div class="space-y-2">
                                <x-input-label :value="__('art-works.edit.current_image')" />
                                <div class="relative group">
                                    <img src="{{ asset($artWork->image) }}" alt="{{ $artWork->title }}"
                                        class="w-full h-64 object-cover rounded-lg">
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 rounded-lg">
                                    </div>
                                </div>
                            </div>

                            <!-- New Image Upload -->
                            <div class="space-y-2">
                                <x-input-label for="{{ ArtWorkFields::IMAGE }}" :value="__('art-works.edit.new_image')" />
                                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 dark:border-gray-600 px-6 py-10"
                                    x-data="{ files: null }" @dragover.prevent="$el.classList.add('border-sage-500')"
                                    @dragleave.prevent="$el.classList.remove('border-sage-500')"
                                    @drop.prevent="files = $event.dataTransfer.files; $el.classList.remove('border-sage-500')">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="mt-4 flex text-sm leading-6 text-gray-600 dark:text-gray-400">
                                            <label for="{{ ArtWorkFields::IMAGE }}"
                                                class="relative cursor-pointer rounded-md bg-white dark:bg-gray-800 font-semibold text-sage-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-sage-600 focus-within:ring-offset-2 hover:text-sage-500">
                                                <span>{{ __('art-works.edit.change_image') }}</span>
                                                <input id="{{ ArtWorkFields::IMAGE }}"
                                                    name="{{ ArtWorkFields::IMAGE }}" type="file" class="sr-only"
                                                    accept="image/*" @change="files = $event.target.files">
                                            </label>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-600 dark:text-gray-400">
                                            {{ __('art-works.create.image_formats') }}
                                        </p>
                                        <div x-show="files" class="mt-4 flex items-center justify-center text-sage-500">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span x-text="files ? files[0].name : ''"></span>
                                        </div>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get(ArtWorkFields::IMAGE)" class="mt-2" />
                            </div>

                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <!-- Title -->
                                <div class="col-span-2">
                                    <x-input-label for="{{ ArtWorkFields::TITLE }}" :value="__('art-works.create.artwork_title')" />
                                    <x-text-input id="{{ ArtWorkFields::TITLE }}" class="block mt-2 w-full"
                                        type="text" name="{{ ArtWorkFields::TITLE }}" :value="old(ArtWorkFields::TITLE, $artWork->title)"
                                        placeholder="{{ __('art-works.create.artwork_title_placeholder') }}"
                                        required />
                                    <x-input-error :messages="$errors->get(ArtWorkFields::TITLE)" class="mt-2" />
                                </div>

                                <!-- Description -->
                                <div class="col-span-2">
                                    <x-input-label for="{{ ArtWorkFields::DESCRIPTION }}" :value="__('art-works.create.description')" />
                                    <textarea id="{{ ArtWorkFields::DESCRIPTION }}" name="{{ ArtWorkFields::DESCRIPTION }}" rows="4"
                                        class="mt-2 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-sage-500 focus:ring-sage-500 dark:bg-gray-700 dark:text-gray-300"
                                        placeholder="{{ __('art-works.create.description_placeholder') }}" required>{{ old(ArtWorkFields::DESCRIPTION, $artWork->description) }}</textarea>
                                    <x-input-error :messages="$errors->get(ArtWorkFields::DESCRIPTION)" class="mt-2" />
                                </div>

                                <!-- Category -->
                                <div>
                                    <x-input-label for="{{ ArtWorkFields::CATEGORY }}" :value="__('art-works.create.category')" />
                                    <select id="{{ ArtWorkFields::CATEGORY }}" name="{{ ArtWorkFields::CATEGORY }}"
                                        class="mt-2 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-sage-500 focus:ring-sage-500 dark:bg-gray-700 dark:text-gray-300">
                                        <option value="">{{ __('art-works.create.select_category') }}</option>
                                        @foreach (['painting', 'sculpture', 'digital', 'photography'] as $category)
                                            <option value="{{ $category }}"
                                                {{ old(ArtWorkFields::CATEGORY, $artWork->category) == $category ? 'selected' : '' }}>
                                                {{ __("art-works.categories.$category") }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get(ArtWorkFields::CATEGORY)" class="mt-2" />
                                </div>
                            </div>

                            <div class="flex items-center justify-between gap-4">
                                <x-danger-button type="button"
                                    onclick="if(confirm('{{ __('art-works.edit.delete_confirm') }}')) { document.getElementById('delete-form').submit(); }">
                                    {{ __('art-works.edit.delete') }}
                                </x-danger-button>

                                <div class="flex items-center gap-4">
                                    <x-secondary-button type="button" onclick="window.history.back()">
                                        {{ __('art-works.create.cancel') }}
                                    </x-secondary-button>
                                    <x-primary-button>
                                        {{ __('art-works.edit.submit') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </form>

                        <form id="delete-form" action="{{ route('art-works.destroy', $artWork) }}" method="POST"
                            class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // اضافه کردن پیش‌نمایش تصویر جدید
            document.getElementById('{{ ArtWorkFields::IMAGE }}').addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // نمایش پیش‌نمایش تصویر
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        </script>
    @endpush
</x-app-layout>
