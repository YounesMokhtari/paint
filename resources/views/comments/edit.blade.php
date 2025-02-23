<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">Edit Comment</h2>

                    <form action="{{ route('comments.update', $comment) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Content</label>
                            <textarea name="content" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                                required>{{ old('content', $comment->content) }}</textarea>
                        </div>

                        <button type="submit"
                            class="bg-sage-500 text-white px-4 py-2 rounded-full hover:bg-sage-600 transition">
                            Update Comment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
