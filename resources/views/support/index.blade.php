<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8 flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-serif text-gray-800 dark:text-gray-200">
                        پشتیبانی و مشاوره
                    </h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        سوالات و درخواست‌های خود را با ما در میان بگذارید
                    </p>
                </div>
                <a href="{{ route('tickets.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-sage-500 text-white rounded-full hover:bg-sage-600">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4"/>
                    </svg>
                    ایجاد تیکت جدید
                </a>
            </div>

            <!-- Tickets List -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse($tickets as $ticket)
                        <div class="border-b border-gray-200 dark:border-gray-700 py-4
                                  hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ $ticket->subject }}
                                    </h3>
                                    <div class="mt-1 flex items-center space-x-4 text-sm text-gray-500">
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
                                <a href="{{ route('tickets.show', $ticket) }}"
                                   class="text-sage-500 hover:text-sage-600">
                                    مشاهده جزئیات
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-gray-500 dark:text-gray-400">
                                هنوز تیکتی ثبت نکرده‌اید
                            </p>
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $tickets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
