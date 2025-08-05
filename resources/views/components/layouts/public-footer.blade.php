<footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="flex items-center justify-center mb-6">
                <a href="/" class="flex items-center">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 w-10 h-10 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.586 2.586a2 2 0 010 2.828l-8.485 8.485M7 17h.01" />
                        </svg>
                    </div>
                    <h2 class="ml-3 text-2xl font-bold">PaintHub</h2>
                </a>
            </div>
            <p class="text-gray-400 max-w-2xl mx-auto mb-8">
                A creative community for artists to participate in painting competitions, showcase their work, 
                and connect with fellow creators.
            </p>
            <div class="flex justify-center space-x-6">
                <a href="{{ route('competitions.public') }}" class="text-gray-300 hover:text-white transition-colors duration-300">
                    Competitions
                </a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">
                    About
                </a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">
                    Contact
                </a>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-800 text-gray-400 text-sm">
                &copy; {{ date('Y') }} PaintHub. All rights reserved.
            </div>
        </div>
    </div>
</footer>
