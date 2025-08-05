<div>
    <flux:card class="space-y-6">
        <flux:heading size="xl">Submit Your Painting</flux:heading>
        
        <div class="flex justify-center">
            <img src="{{ Storage::url($competition->reference_image_path) }}" 
                 alt="{{ $competition->title }}" 
                 class="rounded-lg shadow-lg max-w-full h-auto">
        </div>
        
        <p class="text-center text-gray-600 dark:text-gray-400">
            Based on the reference image above, submit your interpretation of this painting.
        </p>

        @if (session()->has('message'))
            <flux:callout variant="success" :heading="session('message')" />
        @endif

        @if (session()->has('error'))
            <flux:callout variant="danger" :heading="session('error')" />
        @endif

        @if($competition->isSubmissionOpen())
            <form wire:submit="submitPainting">
                <flux:input type="file" wire:model="image" label="Your Painting" required />

                <flux:input wire:model="title" label="Painting Title" placeholder="Enter a title for your painting" required />

                <flux:textarea wire:model="description" label="Description" placeholder="Tell us about your interpretation..." />

                <flux:button type="submit" variant="primary">Submit Painting</flux:button>
            </form>
        @else
            <flux:callout variant="danger" :heading="'Submission deadline has passed. This competition is no longer accepting submissions.'" />
        @endif
    </flux:card>
</div>
