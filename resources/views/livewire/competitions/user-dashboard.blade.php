<div>
    <flux:heading size="xl">Painting Competitions</flux:heading>

    <div class="mt-6">
        <flux:heading size="lg">Active Competitions</flux:heading>
        
        @if($activeCompetitions->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @foreach($activeCompetitions as $competition)
                    <flux:card>
                        <flux:heading size="sm">{{ $competition->title }}</flux:heading>
                        
                        @if($competition->description)
                            <p class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                {{ Str::limit($competition->description, 100) }}
                            </p>
                        @endif
                        
                        <img src="{{ Storage::url($competition->reference_image_path) }}" 
                             alt="{{ $competition->title }}" 
                             class="rounded-lg shadow-lg max-w-full h-auto mt-4">
                        
                        <div class="mt-4 space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Submissions:</span>
                                <span class="text-sm font-semibold">{{ $competition->submissions->count() }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Deadline:</span>
                                <span class="text-sm font-semibold">{{ $competition->submission_deadline->format('M j, Y') }}</span>
                            </div>
                            
                            <div class="mt-4">
                                @if($competition->isSubmissionOpen())
                                    <flux:badge variant="success">Open for Submissions</flux:badge>
                                @elseif($competition->isVotingOpen())
                                    <flux:badge variant="warning">Open for Voting</flux:badge>
                                @endif
                            </div>
                        </div>
                        
                        <flux:button wire:navigate href="{{ route('competitions.show', $competition) }}" class="mt-4 w-full">
                            View Competition
                        </flux:button>
                    </flux:card>
                @endforeach
            </div>
        @else
            <div class="mt-6 text-center py-12">
                <flux:icon name="trophy" variant="outline" class="mx-auto h-12 w-12 text-gray-400" />
                <flux:heading class="mt-4">No active competitions</flux:heading>
                <flux:subheading>Check back later for new competitions</flux:subheading>
            </div>
        @endif
    </div>

    <div class="mt-12">
        <flux:heading size="lg">Past Competitions</flux:heading>
        
        @if($pastCompetitions->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @foreach($pastCompetitions as $competition)
                    <flux:card>
                        <flux:heading size="sm">{{ $competition->title }}</flux:heading>
                        
                        @if($competition->description)
                            <p class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                {{ Str::limit($competition->description, 100) }}
                            </p>
                        @endif
                        
                        <img src="{{ Storage::url($competition->reference_image_path) }}" 
                             alt="{{ $competition->title }}" 
                             class="rounded-lg shadow-lg max-w-full h-auto mt-4">
                        
                        <div class="mt-4 space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Submissions:</span>
                                <span class="text-sm font-semibold">{{ $competition->submissions->count() }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Winner:</span>
                                <span class="text-sm font-semibold">
                                    @php
                                        $winner = $competition->submissions->sortByDesc(function($submission) {
                                            return $submission->voteCount();
                                        })->first();
                                    @endphp
                                    
                                    @if($winner)
                                        {{ $winner->user->name }}
                                    @else
                                        No submissions
                                    @endif
                                </span>
                            </div>
                            
                            <flux:badge variant="danger" class="mt-4">Closed</flux:badge>
                        </div>
                        
                        <flux:button wire:navigate href="{{ route('competitions.show', $competition) }}" class="mt-4 w-full">
                            View Results
                        </flux:button>
                    </flux:card>
                @endforeach
            </div>
        @else
            <div class="mt-6 text-center py-12">
                <flux:icon name="archive-box" variant="outline" class="mx-auto h-12 w-12 text-gray-400" />
                <flux:heading class="mt-4">No past competitions</flux:heading>
                <flux:subheading>Competitions will appear here after they close</flux:subheading>
            </div>
        @endif
    </div>
</div>
