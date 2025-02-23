<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">Reply to Topic</h2>

                    <form action="{{ route('forum-replies.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="topic_id" value="{{ $topic->id }}">

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Your Reply</label>
                            <textarea name="content" rows="6" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                                required></textarea>
                            @error('content')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="bg-sage-500 text-white px-4 py-2 rounded-full hover:bg-sage-600 transition">
                            Post Reply
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
