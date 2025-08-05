<div class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Painting Competitions</h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Join our creative community and showcase your artistic skills. Browse current competitions and see amazing submissions from our artists.
                </p>
            </div>

            <!-- Active Competitions Section -->
            <section class="mb-16">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Active Competitions</h2>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $activeCompetitions->count() }} competitions running
                    </div>
                </div>

                @if($activeCompetitions->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($activeCompetitions as $competition)
                            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                                <div class="relative">
                                    <img src="{{ Storage::url($competition->reference_image_path) }}" 
                                         alt="{{ $competition->title }}" 
                                         class="w-full h-48 object-cover">
                                    <div class="absolute top-4 right-4">
                                        @if($competition->isSubmissionOpen())
                                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                                Submissions Open
                                            </span>
                                        @elseif($competition->isVotingOpen())
                                            <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                                Voting Open
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $competition->title }}</h3>
                                    
                                    @if($competition->description)
                                        <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm">
                                            {{ Str::limit($competition->description, 100) }}
                                        </p>
                                    @endif
                                    
                                    <div class="mt-4 space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500 dark:text-gray-400">Submissions:</span>
                                            <span class="font-medium text-gray-900 dark:text-white">{{ $competition->submissions->count() }}</span>
                                        </div>
                                        
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500 dark:text-gray-400">Deadline:</span>
                                            <span class="font-medium text-gray-900 dark:text-white">
                                                {{ $competition->submission_deadline->format('M j, Y') }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6 flex space-x-3">
                                        <a href="{{ route('competitions.show', $competition) }}" 
                                           class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 text-center">
                                            View Details
                                        </a>
                                        
                                        @auth
                                            @if($competition->isSubmissionOpen())
                                                <a href="{{ route('competitions.submit', $competition) }}" 
                                                   class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 text-center">
                                                    Submit Painting
                                                </a>
                                            @elseif($competition->isVotingOpen())
                                                <a href="{{ route('competitions.vote', $competition) }}" 
                                                   class="flex-1 bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 text-center">
                                                    Vote Now
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" 
                                               class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 text-center">
                                                Login to Participate
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-gray-500 dark:text-gray-400">
                            No active competitions at the moment. Check back soon!
                        </div>
                    </div>
                @endif
            </section>

            <!-- Past Competitions Section -->
            <section>
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Past Competitions</h2>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $pastCompetitions->count() }} competitions completed
                    </div>
                </div>

                @if($pastCompetitions->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($pastCompetitions as $competition)
                            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                                <div class="relative">
                                    <img src="{{ Storage::url($competition->reference_image_path) }}" 
                                         alt="{{ $competition->title }}" 
                                         class="w-full h-48 object-cover">
                                    <div class="absolute top-4 right-4">
                                        <span class="bg-gray-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                            Completed
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $competition->title }}</h3>
                                    
                                    @if($competition->description)
                                        <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm">
                                            {{ Str::limit($competition->description, 100) }}
                                        </p>
                                    @endif
                                    
                                    <div class="mt-4 space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500 dark:text-gray-400">Submissions:</span>
                                            <span class="font-medium text-gray-900 dark:text-white">{{ $competition->submissions->count() }}</span>
                                        </div>
                                        
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500 dark:text-gray-400">Ended:</span>
                                            <span class="font-medium text-gray-900 dark:text-white">
                                                {{ $competition->voting_deadline ? $competition->voting_deadline->format('M j, Y') : 'N/A' }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6">
                                        <a href="{{ route('competitions.show', $competition) }}" 
                                           class="w-full bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 text-center inline-block">
                                            View Results
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-gray-500 dark:text-gray-400">
                            No past competitions available yet.
                        </div>
                    </div>
                @endif
            </section>
    </div>
</div>
