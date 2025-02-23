<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="py-12">
            <div class="container mx-auto px-4">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-8">
                            {{ __('courses.create.title') }}
                        </h2>

                        @if ($errors->any())
                            <div class="mb-8 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative">
                                <strong class="font-bold">{{ __('courses.validation.error_title') }}</strong>
                                <ul class="mt-2 list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf

                            <!-- Title -->
                            <div>
                                <x-input-label for="title" :value="__('courses.form.title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                    :value="old('title')" required autofocus />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div>
                                <x-input-label for="description" :value="__('courses.form.description')" />
                                <textarea id="description" name="description" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500"
                                    required>{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Category -->
                                <div>
                                    <x-input-label for="category_id" :value="__('courses.form.category')" />
                                    <select id="category_id" name="category_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                        <option value="">{{ __('courses.select_category') }}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                </div>

                                <!-- Level -->
                                <div>
                                    <x-input-label for="level" :value="__('courses.form.level')" />
                                    <select id="level" name="level"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                        <option value="">{{ __('courses.select_level') }}</option>
                                        @foreach($levels as $level)
                                            <option value="{{ $level }}" @selected(old('level') == $level)>
                                                {{ __("courses.levels.$level") }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('level')" class="mt-2" />
                                </div>

                                <!-- Price -->
                                <div>
                                    <x-input-label for="price" :value="__('courses.form.price')" />
                                    <x-text-input id="price" name="price" type="number" min="0" step="1000"
                                        class="mt-1 block w-full" :value="old('price')" required />
                                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                </div>

                                <!-- Duration -->
                                <div>
                                    <x-input-label for="duration" :value="__('courses.form.duration')" />
                                    <x-text-input id="duration" name="duration" type="number" min="0" step="0.5"
                                        class="mt-1 block w-full" :value="old('duration')" required />
                                    <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Poster -->
                            <div>
                                <x-input-label for="poster" :value="__('courses.form.poster')" />
                                <input type="file" id="poster" name="poster" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100" />
                                <x-input-error :messages="$errors->get('poster')" class="mt-2" />
                            </div>

                            <!-- Is Featured -->
                            <div class="flex items-center">
                                <input type="checkbox" id="is_featured" name="is_featured" value="1"
                                    class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-500 focus:ring-purple-500"
                                    @checked(old('is_featured'))>
                                <x-input-label for="is_featured" :value="__('courses.form.is_featured')" class="mr-2" />
                            </div>

                            <div class="flex justify-end space-x-4">
                                <x-secondary-button type="button" onclick="window.history.back()">
                                    {{ __('courses.cancel') }}
                                </x-secondary-button>
                                <x-primary-button>
                                    {{ __('courses.create.submit') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
