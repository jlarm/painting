<div>
    <flux:card class="space-y-6">
        <flux:heading size="xl">Vote for Submissions</flux:heading>
        
        @if (session()->has('message'))
            <flux:callout variant="success" :heading="session('message')" />
        @endif

        @if (session()->has('error'))
            <flux:callout variant="danger" :heading="session('error')" />
        @endif

        <p class="text-gray-600 dark:text-gray-400">
            Select the best interpretation of the reference image. You can only vote once.
        </p>

        @if($submissions->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @foreach($submissions as $submission)
                    <flux:card class="cursor-pointer hover:shadow-lg transition-shadow duration-200" 
                               wire:click="voteForSubmission({{ $submission->id }})">
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
                        </div>
                    </flux:card>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <flux:icon name="photo" variant="outline" class="mx-auto h-12 w-12 text-gray-400" />
                <flux:heading class="mt-4">No submissions available</flux:heading>
                <flux:subheading>There are no submissions to vote on for this competition.</flux:subheading>
            </div>
        @endif
    </flux:card>
</div>
