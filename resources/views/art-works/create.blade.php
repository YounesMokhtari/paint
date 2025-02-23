@php
    use App\Models\ArtWorks\ArtWorkFields;
@endphp

<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="py-12">
            <div class="container mx-auto px-4">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-8">
                        <!-- Header -->
                        <h2 class="text-2xl font-bold text-gray-900 mb-8">
                            {{ __('art-works.create.title') }}
                        </h2>

                        @if ($errors->any())
                            <div class="mb-8 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative">
                                <strong class="font-bold">{{ __('art-works.create.error_title') }}</strong>
                                <ul class="mt-2 list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('art-works.store') }}" enctype="multipart/form-data"
                            class="space-y-6">
                            @csrf

                            <!-- Image Upload -->
                            <div>
                                <x-input-label for="{{ ArtWorkFields::IMAGE }}" :value="__('art-works.create.image')" />
                                <div class="mt-2 flex justify-center rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 px-6 py-10 transition-all duration-200 hover:border-sage-400"
                                    x-data="{ files: null }"
                                    @dragover.prevent="$el.classList.add('border-sage-500', 'bg-sage-50')"
                                    @dragleave.prevent="$el.classList.remove('border-sage-500', 'bg-sage-50')"
                                    @drop.prevent="files = $event.dataTransfer.files; $el.classList.remove('border-sage-500', 'bg-sage-50')">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div class="mt-4">
                                            <label for="{{ ArtWorkFields::IMAGE }}"
                                                class="cursor-pointer rounded-md bg-white font-medium text-sage-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-sage-500 focus-within:ring-offset-2 hover:text-sage-500">
                                                <span>{{ __('art-works.create.upload_image') }}</span>
                                                <input id="{{ ArtWorkFields::IMAGE }}" name="{{ ArtWorkFields::IMAGE }}"
                                                    type="file" class="sr-only" accept="image/*"
                                                    @change="files = $event.target.files">
                                            </label>
                                            <p class="text-xs text-gray-500 mt-2">
                                                {{ __('art-works.create.image_formats') }}</p>
                                        </div>
                                        <div x-show="files" x-cloak
                                            class="mt-4 max-w-xs mx-auto bg-sage-50 rounded-lg px-3 py-2">
                                            <div class="flex items-center justify-center text-sage-600">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span x-text="files ? files[0].name : ''" class="text-sm"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get(ArtWorkFields::IMAGE)" class="mt-2" />
                            </div>

                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <!-- Title -->
                                <div class="col-span-2">
                                    <x-input-label for="{{ ArtWorkFields::TITLE }}" :value="__('art-works.create.artwork_title')" />
                                    <x-text-input id="{{ ArtWorkFields::TITLE }}" class="mt-1 block w-full"
                                        type="text" name="{{ ArtWorkFields::TITLE }}" :value="old(ArtWorkFields::TITLE)"
                                        :placeholder="__('art-works.create.artwork_title_placeholder')" required />
                                    <x-input-error :messages="$errors->get(ArtWorkFields::TITLE)" class="mt-2" />
                                </div>

                                <!-- Description -->
                                <div class="col-span-2">
                                    <x-input-label for="{{ ArtWorkFields::DESCRIPTION }}" :value="__('art-works.create.description')" />
                                    <textarea id="{{ ArtWorkFields::DESCRIPTION }}" name="{{ ArtWorkFields::DESCRIPTION }}" rows="4"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sage-500 focus:ring-sage-500"
                                        :placeholder="__('art-works.create.description_placeholder')" required>{{ old(ArtWorkFields::DESCRIPTION) }}</textarea>
                                    <x-input-error :messages="$errors->get(ArtWorkFields::DESCRIPTION)" class="mt-2" />
                                </div>

                                <!-- Category -->
                                <div>
                                    <x-input-label for="{{ ArtWorkFields::CATEGORY }}" :value="__('art-works.create.category')" />
                                    <select id="{{ ArtWorkFields::CATEGORY }}" name="{{ ArtWorkFields::CATEGORY }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sage-500 focus:ring-sage-500">
                                        <option value="">{{ __('art-works.create.select_category') }}</option>
                                        @foreach (['painting', 'sculpture', 'digital', 'photography'] as $category)
                                            <option value="{{ $category }}"
                                                {{ old(ArtWorkFields::CATEGORY) == $category ? 'selected' : '' }}>
                                                {{ __("art-works.categories.$category") }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get(ArtWorkFields::CATEGORY)" class="mt-2" />
                                </div>
                            </div>

                            <div class="flex justify-end space-x-4">
                                <x-secondary-button type="button" onclick="window.history.back()">
                                    {{ __('art-works.create.cancel') }}
                                </x-secondary-button>
                                <x-primary-button>
                                    {{ __('art-works.create.submit') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
