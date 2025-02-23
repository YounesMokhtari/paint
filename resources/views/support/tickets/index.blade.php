<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Support Tickets</h2>
                        <a href="{{ route('support.tickets.create') }}"
                            class="bg-sage-500 text-white px-4 py-2 rounded-full hover:bg-sage-600 transition">
                            New Ticket
                        </a>
                    </div>

                    <div class="space-y-4">
                        @foreach ($tickets as $ticket)
                            <div class="bg-white p-6 rounded-lg border">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-xl font-serif mb-2">
                                            <a href="{{ route('support.tickets.show', $ticket) }}"
                                                class="text-sage-900 hover:text-sage-700">
                                                {{ $ticket->subject }}
                                            </a>
                                        </h3>
                                        <div class="flex items-center text-sage-500 text-sm">
                                            <span>Status: {{ ucfirst($ticket->status) }}</span>
                                            <span class="mx-2">•</span>
                                            <span>{{ $ticket->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $tickets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
