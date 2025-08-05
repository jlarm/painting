<div>
    <flux:heading size="xl">{{ $competition->title }}</flux:heading>
    
    @if($competition->description)
        <flux:subheading class="mt-2">{{ $competition->description }}</flux:subheading>
    @endif

    <flux:card class="mt-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <flux:heading size="sm">Reference Image</flux:heading>
                <img src="{{ Storage::url($competition->reference_image_path) }}" 
                     alt="{{ $competition->title }}" 
                     class="rounded-lg shadow-lg max-w-full h-auto mt-2">
            </div>
            
            <div class="md:col-span-2">
                <flux:heading size="sm">Competition Details</flux:heading>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <flux:card>
                        <flux:heading size="xs">Submission Deadline</flux:heading>
                        <p class="mt-2">{{ $competition->submission_deadline->format('F j, Y g:i A') }}</p>
                        @if($competition->isSubmissionOpen())
                            <flux:badge variant="success" class="mt-2">Open</flux:badge>
                        @else
                            <flux:badge variant="danger" class="mt-2">Closed</flux:badge>
                        @endif
                    </flux:card>
                    
                    <flux:card>
                        <flux:heading size="xs">Voting Deadline</flux:heading>
                        <p class="mt-2">
                            @if($competition->voting_deadline)
                                {{ $competition->voting_deadline->format('F j, Y g:i A') }}
                            @else
                                Not set
                            @endif
                        </p>
                        @if($competition->isVotingOpen())
                            <flux:badge variant="warning" class="mt-2">Open</flux:badge>
                        @elseif($competition->isClosed())
                            <flux:badge variant="danger" class="mt-2">Closed</flux:badge>
                        @else
                            <flux:badge variant="info" class="mt-2">Not started</flux:badge>
                        @endif
                    </flux:card>
                </div>
                
                <div class="mt-6 space-y-4">
                    @if(auth()->user()->isAdmin())
                        <flux:button wire:navigate href="{{ route('competitions.admin') }}" icon="arrow-left">
                            Back to Admin Dashboard
                        </flux:button>
                    @else
                        @if($competition->isSubmissionOpen())
                            @if($userHasSubmitted)
                                <flux:callout variant="success" :heading="'You have already submitted to this competition.'" />
                            @else
                                <flux:button wire:navigate href="{{ route('competitions.submit', $competition) }}" variant="primary" icon="plus">
                                    Submit Your Painting
                                </flux:button>
                            @endif
                        @elseif($competition->isVotingOpen())
                            @if($userHasVoted)
                                <flux:callout variant="success" :heading="'You have already voted in this competition.'" />
                            @else
                                <flux:button wire:navigate href="{{ route('competitions.vote', $competition) }}" variant="primary" icon="hand-thumb-up">
                                    Vote for Submissions
                                </flux:button>
                            @endif
                        @elseif($competition->isClosed())
                            <flux:callout variant="info" :heading="'This competition is closed.'" />
                        @endif
                    @endif
                </div>
            </div>
        </div>
        
        <div class="mt-8">
            <flux:heading size="lg">Submissions ({{ $submissions->count() }})</flux:heading>
            
            @if($submissions->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    @foreach($submissions as $submission)
                        <flux:card>
                            <img src="{{ Storage::url($submission->image_path) }}" 
                                 alt="Submission by {{ $submission->user->name }}" 
                                 class="rounded-lg shadow-lg max-w-full h-auto">
                            
                            <div class="mt-4">
                                <flux:heading size="sm">By {{ $submission->user->name }}</flux:heading>
                                
                                @if($submission->description)
                                    <p class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                        {{ $submission->description }}
                                    </p>
                                @endif
                                
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-sm text-gray-500">
                                        Submitted {{ $submission->created_at->format('M j, Y') }}
                                    </span>
                                    <span class="text-sm font-semibold">
                                        {{ $submission->voteCount() }} votes
                                    </span>
                                </div>
                            </div>
                        </flux:card>
                    @endforeach
                </div>
            @else
                <div class="mt-6 text-center py-12">
                    <flux:icon name="photo" variant="outline" class="mx-auto h-12 w-12 text-gray-400" />
                    <flux:heading class="mt-4">No submissions yet</flux:heading>
                    <flux:subheading>Be the first to submit your painting!</flux:subheading>
                </div>
            @endif
        </div>
    </flux:card>
</div>
