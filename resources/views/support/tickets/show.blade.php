<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-8">
                        <h2 class="text-3xl font-serif mb-4">Ticket #{{ $supportTicket->id }}</h2>
                        <div class="flex items-center text-sage-500 mb-4">
                            <span
                                class="px-3 py-1 rounded-full {{ $supportTicket->status === 'open' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($supportTicket->status) }}
                            </span>
                            <span class="mx-2">•</span>
                            <span>Created {{ $supportTicket->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg mb-8">
                        <h3 class="font-bold mb-2">Subject</h3>
                        <p class="text-gray-700 mb-4">{{ $supportTicket->subject }}</p>

                        <h3 class="font-bold mb-2">Message</h3>
                        <p class="text-gray-700">{{ $supportTicket->message }}</p>
                    </div>

                    @if ($supportTicket->replies->count() > 0)
                        <div class="space-y-4 mb-8">
                            <h3 class="text-xl font-bold mb-4">Replies</h3>
                            @foreach ($supportTicket->replies as $reply)
                                <div class="bg-white p-4 rounded-lg border">
                                    <div class="flex justify-between items-start mb-2">
                                        <span class="font-medium">
                                            {{ $reply->user->name }}
                                            @if ($reply->user->is_admin)
                                                <span class="text-sage-500 text-sm">(Support Staff)</span>
                                            @endif
                                        </span>
                                        <span class="text-gray-500 text-sm">
                                            {{ $reply->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-gray-700">{{ $reply->message }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if ($supportTicket->status === 'open')
                        <div>
                            <h3 class="text-xl font-bold mb-4">Add Reply</h3>
                            <form action="{{ route('support-tickets.reply.store', $supportTicket) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <textarea name="message" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                                        required></textarea>
                                </div>
                                <button type="submit"
                                    class="bg-sage-500 text-white px-4 py-2 rounded-full hover:bg-sage-600 transition">
                                    Send Reply
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
