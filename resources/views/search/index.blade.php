<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-4">نتایج جستجو</h1>

        <!-- نمایش اطلاعات جستجو -->
        @if ($query && $category)
            <p class="text-gray-700"><strong>جستجو:</strong> {{ $query }}</p>
            <p class="text-gray-700"><strong>دسته‌بندی:</strong> {{ $category }}</p>
        @else
            <p class="text-gray-500">هیچ عبارت جستجو یا دسته‌بندی ارائه نشده است.</p>
        @endif

        <!-- نمایش سطح در صورت وجود -->
        @isset($level)
            <p class="text-gray-700"><strong>سطح:</strong> {{ $level }}</p>
        @endisset

        <!-- لیست دوره‌ها -->
        <h2 class="text-xl font-semibold mt-6 border-b pb-2">دوره‌ها</h2>
        @forelse ($courses as $course)
            <div class="border rounded-lg p-4 mt-4 shadow-sm">
                <h3 class="text-lg font-semibold">{{ $course->title }}</h3>
                <p class="text-gray-600">{{ $course->description }}</p>

                @if (!empty($course->metadata))
                    <ul class="list-disc list-inside mt-2 text-sm text-gray-700">
                        @foreach ($course->metadata as $item)
                            <li><strong>{{ $item['key'] }}:</strong> {{ $item['value'] }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @empty
            <p class="text-gray-500 mt-4">هیچ دوره‌ای یافت نشد.</p>
        @endforelse

        <!-- لیست آثار هنری -->
        <h2 class="text-xl font-semibold mt-6 border-b pb-2">آثار هنری</h2>
        @forelse ($artworks as $artwork)
            <div class="border rounded-lg p-4 mt-4 shadow-sm">
                <h3 class="text-lg font-semibold">{{ $artwork->title }}</h3>

                @if (!empty($artwork->metadata))
                    <ul class="list-disc list-inside mt-2 text-sm text-gray-700">
                        @foreach ($artwork->metadata as $item)
                            <li><strong>{{ $item['key'] }}:</strong> {{ $item['value'] }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @empty
            <p class="text-gray-500 mt-4">هیچ اثر هنری یافت نشد.</p>
        @endforelse
    </div>
</x-app-layout>
