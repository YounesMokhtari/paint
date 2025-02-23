<div id="lessonModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-xl mx-4">
        <h3 class="text-lg font-bold mb-4 dark:text-white">{{ __('courses.lessons.add_new') }}</h3>

        <form action="{{ route('courses.lessons.store', $course) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-4">
                <!-- Title -->
                <div>
                    <x-input-label for="title" :value="__('courses.lessons.title')" />
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Description -->
                <div>
                    <x-input-label for="description" :value="__('courses.lessons.description')" />
                    <textarea id="description" name="description" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-500 focus:ring-purple-500"></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Video -->
                <div>
                    <x-input-label for="video" :value="__('courses.lessons.video')" />
                    <input type="file" id="video" name="video" accept="video/*" required
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100" />
                    <p class="mt-1 text-sm text-gray-500">{{ __('courses.lessons.video_help') }}</p>
                    <x-input-error :messages="$errors->get('video')" class="mt-2" />
                </div>

                <!-- Duration -->
                <div>
                    <x-input-label for="duration" :value="__('courses.lessons.duration')" />
                    <x-text-input id="duration" name="duration" type="number" step="0.1" min="0"
                        class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                </div>

                <!-- Is Preview -->
                <div class="flex items-center">
                    <input type="checkbox" id="is_preview" name="is_preview" value="1"
                        class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-500 focus:ring-purple-500" />
                    <x-input-label for="is_preview" :value="__('courses.lessons.is_preview')" class="mr-2" />
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-4">
                <x-secondary-button type="button" onclick="closeLessonModal()">
                    {{ __('courses.cancel') }}
                </x-secondary-button>
                <x-primary-button>
                    {{ __('courses.lessons.save') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>

<script>
function openLessonModal() {
    document.getElementById('lessonModal').classList.remove('hidden');
    document.getElementById('lessonModal').classList.add('flex');
}

function closeLessonModal() {
    document.getElementById('lessonModal').classList.remove('flex');
    document.getElementById('lessonModal').classList.add('hidden');
}
</script>
