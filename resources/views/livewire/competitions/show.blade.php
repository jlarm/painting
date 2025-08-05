<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-900">{{ $competition->title }}</h1>
        @if($competition->description)
            <p class="mt-2 text-lg text-gray-600 max-w-3xl mx-auto">{{ $competition->description }}</p>
        @endif
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Reference Image</h2>
                <img src="{{ Storage::url($competition->reference_image_path) }}" alt="{{ $competition->title }}" class="rounded-lg shadow-md w-full h-auto">
            </div>
            
            <div class="md:col-span-2">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Competition Details</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-600">Submission Deadline</h3>
                        <p class="text-gray-800 text-sm mt-1">{{ $competition->submission_deadline->format('F j, Y g:i A') }}</p>
                        @if($competition->isSubmissionOpen())
                            <span class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Open</span>
                        @else
                            <span class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Closed</span>
                        @endif
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-600">Voting Deadline</h3>
                        <p class="text-gray-800 text-sm mt-1">
                            {{ $competition->voting_deadline ? $competition->voting_deadline->format('F j, Y g:i A') : 'Not set' }}
                        </p>
                        @if($competition->isVotingOpen())
                            <span class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Voting Open</span>
                        @elseif($competition->isClosed())
                            <span class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Completed</span>
                        @else
                            <span class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Not Started</span>
                        @endif
                    </div>
                </div>
                
                <div class="mt-6">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('competitions.admin') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-600 hover:bg-gray-700">Back to Admin</a>
                        @else
                            @if($competition->isSubmissionOpen())
                                @if($userHasSubmitted)
                                    <div class="rounded-md bg-green-50 p-4">
                                        <p class="text-sm font-medium text-green-800">You have already submitted to this competition.</p>
                                    </div>
                                @else
                                    <a href="{{ route('competitions.submit', $competition) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">Submit Your Painting</a>
                                @endif
                            @elseif($competition->isVotingOpen())
                                @if($userHasVoted)
                                    <div class="rounded-md bg-blue-50 p-4">
                                        <p class="text-sm font-medium text-blue-800">You have already voted in this competition.</p>
                                    </div>
                                @else
                                    <a href="{{ route('competitions.vote', $competition) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700">Vote for Submissions</a>
                                @endif
                            @elseif($competition->isClosed())
                                <div class="rounded-md bg-gray-50 p-4">
                                    <p class="text-sm font-medium text-gray-800">This competition is closed.</p>
                                </div>
                            @endif
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">Login to Participate</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Submissions ({{ $submissions->count() }})</h2>
        
        @if($submissions->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($submissions as $submission)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <img src="{{ Storage::url($submission->image_path) }}" alt="Submission by {{ $submission->user->name }}" class="w-full h-64 object-cover">
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800">By {{ $submission->user->name }}</h3>
                            @if($submission->description)
                                <p class="mt-1 text-gray-600 text-sm">{{ Str::limit($submission->description, 80) }}</p>
                            @endif
                            <div class="mt-3 flex justify-between items-center">
                                <span class="text-xs text-gray-500">{{ $submission->created_at->diffForHumans() }}</span>
                                @if($competition->isVotingOpen() || $competition->isClosed())
                                    <span class="font-bold text-sm text-gray-700">Votes: {{ $submission->votes_count ?? 0 }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-lg shadow-md">
                <p class="text-gray-500">No submissions yet. Be the first to enter!</p>
            </div>
        @endif
    </div>
</div>
