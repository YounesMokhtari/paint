<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Chat Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">{{ __('support.chat_with_teacher') }}</h2>
                        <span class="text-sm text-gray-500">{{ $teacher->name }}</span>
                    </div>

                    <!-- Chat Messages -->
                    <div class="space-y-4 mb-6 h-96 overflow-y-auto" id="chat-messages">
                        @foreach($messages as $message)
                            <div class="flex {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-[70%] {{ $message->user_id === auth()->id() ? 'bg-primary-100' : 'bg-gray-100' }} rounded-lg p-3">
                                    <p class="text-sm">{{ $message->content }}</p>
                                    <span class="text-xs text-gray-500">{{ $message->created_at->format('H:i') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Message Input -->
                    <form action="{{ route('support.send-message') }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="text" name="message"
                               class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                               placeholder="{{ __('support.type_message') }}" required>
                        <button type="submit"
                                class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            {{ __('support.send') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
