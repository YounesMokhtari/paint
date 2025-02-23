<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">Edit Video</h2>

                    <form action="{{ route('videos.update', $video) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                            <input type="text" name="title" value="{{ old('title', $video->title) }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <textarea name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                                required>{{ old('description', $video->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Duration (minutes)</label>
                            <input type="number" name="duration" value="{{ old('duration', $video->duration) }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>

                        <button type="submit"
                            class="bg-sage-500 text-white px-4 py-2 rounded-full hover:bg-sage-600 transition">
                            Update Video
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
