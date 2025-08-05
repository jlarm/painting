<header class="bg-white/80 backdrop-blur-sm border-b border-gray-200/50 sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <a href="/" class="flex items-center">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 w-10 h-10 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.586 2.586a2 2 0 010 2.828l-8.485 8.485M7 17h.01" />
                        </svg>
                    </div>
                    <h1 class="ml-3 text-2xl font-bold text-gray-900">PaintHub</h1>
                </a>
            </div>
            
            <nav class="flex items-center space-x-4">
                <a href="{{ route('competitions.public') }}" class="text-gray-600 hover:text-indigo-600 font-medium transition-colors duration-300">Competitions</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-300">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-transparent hover:bg-gray-100 text-indigo-600 px-4 py-2 rounded-lg font-medium transition-colors duration-300">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-300">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        </div>
    </div>
</header>
