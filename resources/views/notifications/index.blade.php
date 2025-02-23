<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">{{ __('notifications.title') }}</h2>

                    <div class="space-y-4">
                        @forelse($notifications as $notification)
                            <div class="p-4 rounded-lg {{ $notification->isUnread() ? 'bg-primary-50' : 'bg-white' }} border">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="font-medium {{ $notification->isUnread() ? 'text-primary-900' : 'text-gray-900' }}">
                                            {{ $notification->title }}
                                        </h3>
                                        <p class="text-gray-600 mt-1">{{ $notification->content }}</p>
                                        <div class="mt-2 text-sm text-gray-500">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </div>
                                    </div>

                                    @if($notification->isUnread())
                                        <form action="{{ route('notifications.mark-as-read', $notification) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="text-sm text-primary-600 hover:text-primary-700">
                                                {{ __('notifications.mark_as_read') }}
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                @if($notification->notifiable)
                                    <a href="{{ route($notification->type . '.show', $notification->notifiable) }}"
                                        class="mt-3 inline-block text-sm text-primary-600 hover:text-primary-700">
                                        {{ __('notifications.view_details') }} →
                                    </a>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                {{ __('notifications.no_notifications') }}
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
