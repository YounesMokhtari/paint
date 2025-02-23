<div id="videoModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-xl mx-4">
        <h3 class="text-lg font-bold mb-4 dark:text-white">{{ __('courses.video.add_new') }}</h3>
        <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">

            <div class="space-y-4">
                <div>
                    <x-input-label for="title" :value="__('courses.video.title')" />
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="description" :value="__('courses.video.description')" />
                    <textarea id="description" name="description" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-sage-500 focus:ring-sage-500"></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="video_file" :value="__('courses.video.file')" />
                    <input type="file" id="video_file" name="video" accept="video/*" required
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sage-50 file:text-sage-700 hover:file:bg-sage-100">
                    <x-input-error :messages="$errors->get('video')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="duration" :value="__('courses.video.duration')" />
                    <x-text-input id="duration" name="duration" type="number" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3 space-x-reverse">
                <x-secondary-button type="button" onclick="closeVideoModal()">
                    {{ __('courses.video.cancel') }}
                </x-secondary-button>
                <x-primary-button type="submit">
                    {{ __('courses.video.save') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
