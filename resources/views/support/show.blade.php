<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Ticket Header -->
                    <div class="border-b border-gray-200 pb-4 mb-6">
                        <h2 class="text-2xl font-bold">{{ $ticket->subject }}</h2>
                        <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                            <span>شماره تیکت: {{ $ticket->id }}</span>
                            <span>{{ $ticket->created_at->format('Y/m/d H:i') }}</span>
                            <span class="px-2 py-1 rounded-full text-xs
                                @if($ticket->status === 'open') bg-green-100 text-green-800
                                @elseif($ticket->status === 'closed') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ __("support.status.{$ticket->status}") }}
                            </span>
                        </div>
                    </div>

                    <!-- Messages -->
                    <div class="space-y-6 mb-8">
                        @foreach($ticket->replies as $reply)
                            <div class="flex gap-4 @if($reply->user_id === $ticket->user_id) flex-row @else flex-row-reverse @endif">
                                <div class="flex-shrink-0">
                                    <img src="{{ $reply->user->profile_photo }}"
                                         alt="{{ $reply->user->name }}"
                                         class="w-10 h-10 rounded-full">
                                </div>
                                <div class="flex-grow">
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="font-medium">{{ $reply->user->name }}</span>
                                            <span class="text-sm text-gray-500">
                                                {{ $reply->created_at->format('Y/m/d H:i') }}
                                            </span>
                                        </div>
                                        <p class="text-gray-700 dark:text-gray-300">
                                            {{ $reply->message }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Reply Form -->
                    @if($ticket->status !== 'closed')
                        <form action="{{ route('support.reply', $ticket) }}" method="POST" class="mt-6">
                            @csrf
                            <div>
                                <x-input-label for="message" value="پاسخ شما" />
                                <textarea id="message" name="message" rows="4"
                                          class="block w-full mt-1 rounded-md border-gray-300"
                                          required></textarea>
                                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                            </div>

                            <div class="mt-4 flex justify-end">
                                <x-primary-button>
                                    ارسال پاسخ
                                </x-primary-button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
