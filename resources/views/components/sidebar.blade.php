<div :class="open ? 'w-64' : 'w-20'" class="bg-gradient-to-b from-orange-500 to-orange-600 text-white shadow-lg transition-all duration-300 ease-in-out rounded-r-3xl">
    <!-- Logo Section -->
    <div class="flex justify-between items-center p-6 border-b border-orange-400">
        <h1 x-show="open" class="text-xl font-bold tracking-wider">RestoApp</h1>
        <button @click="open = !open" class="text-white hover:text-orange-200 transition-colors">
            <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    @auth
        @if(auth()->user()->role == 'admin')
            <!-- Menu Items -->
            <div class="p-4 overflow-y-auto">
                <!-- Workspace Section -->
                <div class="mb-8">
                    <h2 x-show="open" class="text-xs font-semibold text-orange-200 uppercase tracking-wider mb-4">Workspace</h2>
                    <nav class="space-y-2">
                        <!-- Dashboard -->
                        <a href="#" 
                        class="flex items-center space-x-3 p-3 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-orange-400 text-black' : 'hover:bg-orange-400 hover:text-black' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>  
                            <span x-show="open" class="font-medium">Dashboard</span>
                        </a>

                        <!-- Kategori Menu -->
                        <a href="{{ route('admin.kategori-menu') }}" 
                        class="flex items-center space-x-3 p-3 rounded-lg transition-colors {{ request()->routeIs('admin.kategori-menu') ? 'bg-orange-400 text-black' : 'hover:bg-orange-400 hover:text-black' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="4 6h16 4 18h16"></polyline>
                            </svg>
                            <span x-show="open" class="font-medium">Kategori Menu</span>
                        </a>

                        <!-- List Menu -->
                        <a href="{{ route('admin.list-menu') }}" 
                        class="flex items-center space-x-3 p-3 rounded-lg transition-colors {{ request()->routeIs('admin.list-menu') ? 'bg-orange-400 text-black' : 'hover:bg-orange-400 hover:text-black' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                            </svg>
                            <span x-show="open" class="font-medium">List Menu</span>
                        </a>

                        <!-- Kupon Diskon -->
                        <a href="{{ route('admin.kupon') }}" 
                        class="flex items-center space-x-3 p-3 rounded-lg transition-colors {{ request()->routeIs('admin.kupon') ? 'bg-orange-400 text-black' : 'hover:bg-orange-400 hover:text-black' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                            <span x-show="open" class="font-medium">Kupon Diskon</span>
                            <span x-show="open" class="bg-green-400 text-black rounded-full px-2 py-0.5 text-xs font-semibold">5</span>
                        </a>
                    </nav>
                </div>

                <!-- Teams Section -->
                <div x-show="open">
                    <h2 class="text-xs font-semibold text-orange-200 uppercase tracking-wider mb-4">Teams</h2>
                    <nav class="space-y-2">
                        <a href="#" class="flex items-center space-x-3 p-3 rounded-lg transition-colors hover:bg-orange-400 hover:text-black">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span class="font-medium">Marketing</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 p-3 rounded-lg transition-colors hover:bg-orange-400 hover:text-black">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span class="font-medium">Davidronment</span>
                        </a>
                    </nav>
                </div>
            </div>
        @endif
    @endauth
    @guest
    <div class="p-4 overflow-y-auto">
        <!-- Workspace Section -->
        <div class="mb-8">
            <h2 x-show="open" class="text-xs font-semibold text-orange-200 uppercase tracking-wider mb-4">Workspace</h2>
            <nav class="space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('home') }}" 
                class="flex items-center space-x-3 p-3 rounded-lg transition-colors {{ request()->routeIs('home') ? 'bg-orange-400 text-black' : 'hover:bg-orange-400 hover:text-black' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>  
                    <span x-show="open" class="font-medium">Home</span>
                </  a>

                <!-- Kupon Diskon -->
                <a href="{{ route('diskon') }}" 
                class="flex items-center space-x-3 p-3 rounded-lg transition-colors {{ request()->routeIs('diskon') ? 'bg-orange-400 text-black' : 'hover:bg-orange-400 hover:text-black' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                    <span x-show="open" class="font-medium">Kupon Diskon</span>
                </a>
            </nav>
        </div>
    </div>
    @endguest
</div>