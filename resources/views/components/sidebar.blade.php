<div :class="open ? 'w-64' : 'w-20'" class="bg-orange-500 text-white shadow-lg transition-all duration-300 ease-in-out">
            <!-- Logo Section -->
            <div class="flex justify-between items-center p-6 border-b border-orange-400">
                <h1 x-show="open" class="text-xl font-bold">Fintory</h1>
                <button @click="open = !open" class="text-white hover:text-orange-200">
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Menu Items -->
            <div class="p-4 overflow-y-auto">
                <!-- Workspace Section -->
                <div class="mb-8">
                    <h2 x-show="open" class="text-xs font-semibold text-orange-200 uppercase tracking-wider mb-4">Workspace</h2>
                    <nav class="space-y-2">
                        <a href="#" class="flex items-center space-x-3 p-2 hover:bg-orange-400 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>  
                            <span x-show="open">Dashboard</span>
                        </a>
            <a href="{{ route('kategori-menu') }}" class="flex items-center space-x-3 p-2 hover:bg-orange-400 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <span x-show="open">Kategori Menu</span>
            </a>

            <!-- List Menu -->
            <a href="{{ route('list-menu') }}" class="flex items-center space-x-3 p-2 hover:bg-orange-400 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                <span x-show="open">List Menu</span>
            </a>

            <!-- Kupon Diskon -->
            <a href="#" class="flex items-center space-x-3 p-2 hover:bg-orange-400 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
                <span x-show="open">Kupon Diskon</span>
                <span x-show="open" class="bg-green-400 text-black rounded-full px-2 text-sm">5</span>
            </a>
                    </nav>
                </div>

                <!-- Teams Section -->
                <div x-show="open">
                    <h2 class="text-xs font-semibold text-orange-200 uppercase tracking-wider mb-4">Teams</h2>
                    <nav class="space-y-2">
                        <a href="#" class="block p-2 text-sm hover:bg-orange-400 rounded-lg transition-colors">
                            Marketing
                        </a>
                        <a href="#" class="block p-2 text-sm hover:bg-orange-400 rounded-lg transition-colors">
                            Davidronment
                        </a>
                    </nav>
                </div>
            </div>
        </div>