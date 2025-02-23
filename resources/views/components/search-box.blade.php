@props(['placeholder' => ''])

<div class="relative">
    <input type="search" name="search"
        {{ $attributes->merge([
            'class' => 'w-full rounded-lg border-gray-300 pl-10 pr-4 py-2
                           focus:border-sage-500 focus:ring-sage-500
                           dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300
                           transition-all duration-200',
        ]) }}
        placeholder="{{ $placeholder }}" value="{{ request('search') }}">

    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>
</div>
