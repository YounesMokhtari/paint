<div class="max-w-2xl mx-auto">
    <form action="{{ route('search') }}" method="GET" class="relative">
        <input type="text"
               name="q"
               value="{{ request('q') }}"
               class="w-full px-4 py-2 text-gray-900 bg-white border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
               placeholder="{{ __('search.placeholder') }}">

        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
            <button type="submit" class="text-gray-500 hover:text-primary-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>

        <!-- فیلترهای جستجو -->
        <div class="mt-2 flex flex-wrap gap-2">
            <select name="category" class="text-sm border-gray-300 rounded-md">
                <option value="">{{ __('search.all_categories') }}</option>
                <option value="watercolor">{{ __('courses.categories.watercolor') }}</option>
                <option value="oil-painting">{{ __('courses.categories.oil_painting') }}</option>
                <!-- سایر دسته‌بندی‌ها -->
            </select>

            <select name="level" class="text-sm border-gray-300 rounded-md">
                <option value="">{{ __('search.all_levels') }}</option>
                <option value="beginner">{{ __('courses.levels.beginner') }}</option>
                <option value="intermediate">{{ __('courses.levels.intermediate') }}</option>
                <option value="advanced">{{ __('courses.levels.advanced') }}</option>
            </select>
        </div>
    </form>
</div>
