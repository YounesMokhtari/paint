<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">Create Support Ticket</h2>

                    <form action="{{ route('support.tickets.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Subject
                            </label>
                            <input type="text" name="subject"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                                value="{{ old('subject') }}" required>
                            @error('subject')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Message
                            </label>
                            <textarea name="message" rows="6" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                                required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="bg-sage-500 text-white px-4 py-2 rounded-full hover:bg-sage-600 transition">
                                Submit Ticket
                            </button>
                            <a href="{{ route('support.tickets.index') }}" class="text-sage-500 hover:text-sage-600">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
