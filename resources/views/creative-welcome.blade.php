<x-layouts.public>
    <div class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50">
        <!-- Hero Section -->
        <section class="py-16 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                        Unleash Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Creative</span> Potential
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-10">
                        Join our community of artists in exciting painting competitions. Browse current challenges, 
                        submit your artwork, and vote for the most creative submissions.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('competitions.public') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-3 px-8 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                            View Competitions
                        </a>
                        @guest
                        <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 text-indigo-600 border-2 border-indigo-600 font-bold py-3 px-8 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                            Join Community
                        </a>
                        @endguest
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-16 bg-white/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900">How It Works</h2>
                    <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                        Participate in creative challenges and showcase your artistic skills
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="text-center">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Join Competitions</h3>
                        <p class="text-gray-600">
                            Browse our active painting challenges and find inspiration in the reference images provided by admins.
                        </p>
                    </div>
                    
                    <div class="text-center">
                        <div class="bg-gradient-to-r from-green-500 to-teal-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Submit Your Art</h3>
                        <p class="text-gray-600">
                            Create your masterpiece based on the challenge theme and submit it for community voting.
                        </p>
                    </div>
                    
                    <div class="text-center">
                        <div class="bg-gradient-to-r from-amber-500 to-orange-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905a3.61 3.61 0 01-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Vote & Celebrate</h3>
                        <p class="text-gray-600">
                            After submissions close, vote for your favorite artworks and see the winners announced.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layouts.public>
