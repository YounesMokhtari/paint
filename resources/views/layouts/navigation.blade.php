@auth
    <nav x-data="{ open: false }"
        class="bg-white/80 backdrop-blur-sm border-b border-gray-100 sticky top-0 z-50 transition-all duration-300"
        :class="{ 'bg-white/95': open }">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('landing') }}" class="flex items-center space-x-3 group">
                            <x-application-logo
                                class="block h-12 w-auto fill-current text-sage-600 transition-transform duration-300 group-hover:scale-110" />
                            <span class="font-serif text-2xl text-sage-600 tracking-wide">ArtGallery</span>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-12 rtl:space-x-reverse sm:-my-px sm:ml-10 sm:flex">
                        <!-- گالری آثار -->
                        <x-nav-link :href="route('art-works.index')" :active="request()->routeIs('art-works.*')"
                            class="font-serif text-lg hover:text-sage-600 transition-all duration-300 hover:-translate-y-0.5">
                            {{ __('navigation.art_gallery') }}
                        </x-nav-link>

                        <!-- مجله هنری -->
                        <x-nav-link :href="route('blog-posts.index')" :active="request()->routeIs('blog-posts.*')"
                            class="font-serif text-lg hover:text-sage-600 transition-all duration-300 hover:-translate-y-0.5">
                            {{ __('navigation.art_blog') }}
                        </x-nav-link>

                        <!-- آموزش هنر -->
                        <x-nav-link :href="route('courses.index')" :active="request()->routeIs('courses.*')"
                            class="font-serif text-lg hover:text-sage-600 transition-all duration-300 hover:-translate-y-0.5">
                            {{ __('navigation.art_courses') }}
                        </x-nav-link>

                        <!-- انجمن هنرمندان -->
                        <x-nav-link :href="route('forum-topics.index')" :active="request()->routeIs('forum-topics.*')"
                            class="font-serif text-lg hover:text-sage-600 transition-all duration-300 hover:-translate-y-0.5">
                            {{ __('navigation.artists_forum') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-6 rtl:space-x-reverse">
                    <!-- Upload Artwork Button -->
                    <a href="{{ route('art-works.create') }}"
                        class="group relative inline-flex items-center px-6 py-3 bg-sage-500 text-white text-base font-serif rounded-xl
                               hover:bg-sage-600 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                        <span
                            class="absolute inset-0 bg-white/20 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <svg class="w-5 h-5 mr-2 transition-transform duration-300 group-hover:scale-110" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ __('navigation.upload_artwork') }}
                    </a>

                    <!-- Notifications -->
                    <div class="relative">
                        <x-dropdown align="right" width="80">
                            <x-slot name="trigger">
                                <button
                                    class="relative p-2 text-gray-600 hover:text-sage-600 transition-all duration-300 hover:-translate-y-0.5">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    @if (auth()->user()->unreadNotifications()->count() > 0)
                                        <span
                                            class="absolute top-0 right-0 block h-3 w-3 rounded-full bg-rose-500 ring-2 ring-white"></span>
                                    @endif
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="py-2">
                                    @forelse(auth()->user()->notifications()->latest()->take(5)->get() as $notification)
                                        <div
                                            class="px-4 py-3 hover:bg-gray-50 {{ $notification->read_at ? '' : 'bg-sage-50' }} transition-colors duration-200">
                                            <p class="text-sm font-medium text-gray-900">{{ $notification->title }}</p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    @empty
                                        <div class="px-4 py-3 text-sm text-gray-500 italic">
                                            {{ __('navigation.notifications.no_notifications') }}
                                        </div>
                                    @endforelse

                                    <div class="border-t border-gray-100 mt-2 pt-2">
                                        <a href="{{ route('notifications.index') }}"
                                            class="block px-4 py-2 text-sm text-sage-600 hover:bg-gray-50 transition-colors duration-200">
                                            {{ __('navigation.notifications.view_all') }}
                                        </a>
                                    </div>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <!-- User Menu -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center transition-all duration-300 hover:-translate-y-0.5 group">
                                <img src="{{ Auth::user()->profile_photo }}" alt="{{ Auth::user()->name }}"
                                    class="h-10 w-10 rounded-xl object-cover transition-transform duration-300 group-hover:scale-105">
                                <div class="ml-3 text-right">
                                    <div
                                        class="text-sm font-medium text-gray-700 group-hover:text-sage-600 transition-colors duration-200">
                                        {{ Auth::user()->name }}
                                    </div>
                                    <div class="text-xs text-gray-500">هنرمند</div>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ __('navigation.profile') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('art-works.index', ['user' => Auth::id()])" class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ __('navigation.my_artworks') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('tickets.index')" class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                {{ __('navigation.support') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    class="flex items-center text-rose-600 hover:text-rose-700"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    {{ __('navigation.log_out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-lg text-gray-400 hover:text-sage-600 hover:bg-gray-100
                               focus:outline-none transition-all duration-300 hover:-translate-y-0.5">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden transition-all duration-300 ease-in-out">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('art-works.index')" :active="request()->routeIs('art-works.*')" class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ __('navigation.art_gallery') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('blog-posts.index')" :active="request()->routeIs('blog-posts.*')" class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    {{ __('navigation.art_blog') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('courses.index')" :active="request()->routeIs('courses.*')" class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    {{ __('navigation.art_courses') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('forum-topics.index')" :active="request()->routeIs('forum-topics.*')" class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                    </svg>
                    {{ __('navigation.artists_forum') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo }}"
                            alt="{{ Auth::user()->name }}">
                    </div>
                    <div class="ml-3">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        {{ __('navigation.profile') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('art-works.index', ['user' => Auth::id()])" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ __('navigation.my_artworks') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('tickets.index')" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        {{ __('navigation.support') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="flex items-center text-rose-600">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            {{ __('navigation.log_out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>
@endauth
