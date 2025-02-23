@props([
    'type' => 'info',
    'dismissible' => true,
    'floating' => true,
    'position' => 'top-right', // top-right, top-left, bottom-right, bottom-left,
    'title' => null,
])

@php
    $typeClasses = [
        'info' => 'bg-blue-50/95 text-blue-800 border-blue-200',
        'success' => 'bg-sage-50/95 text-sage-800 border-sage-200',
        'warning' => 'bg-amber-50/95 text-amber-800 border-amber-200',
        'error' => 'bg-rose-50/95 text-rose-800 border-rose-200',
    ];

    $iconClasses = [
        'info' => 'text-blue-500',
        'success' => 'text-sage-500',
        'warning' => 'text-amber-500',
        'error' => 'text-rose-500',
    ];

    $icons = [
        'info' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
        'success' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />',
        'warning' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />',
        'error' =>
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />',
    ];

    $positionClasses = [
        'top-right' => 'top-4 right-4',
        'top-left' => 'top-4 left-4',
        'bottom-right' => 'bottom-4 right-4',
        'bottom-left' => 'bottom-4 left-4',
    ];
@endphp

<div x-data="{ show: true }" x-show="show" @class([
    'fixed z-50 max-w-sm w-full shadow-lg backdrop-blur-sm' => $floating,
    $positionClasses[$position] => $floating,
    'relative' => !$floating,
])
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-2">

    <div class="rounded-lg border {{ $typeClasses[$type] }} p-3">
        <div class="flex items-center gap-3">
            <!-- Icon -->
            <div class="flex-shrink-0">
                <svg class="h-4 w-4 {{ $iconClasses[$type] }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    {!! $icons[$type] !!}
                </svg>
            </div>

            <!-- Content -->
            <div class="flex-1 text-sm">
                {{ $title }}
            </div>

            <!-- Dismiss Button -->
            @if ($dismissible)
                <button @click="show = false"
                    class="flex-shrink-0 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sage-500 rounded-lg">
                    <span class="sr-only">بستن</span>
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            @endif
        </div>
    </div>
</div>
