<div>
    <flux:card class="space-y-6">
        <flux:heading size="xl">Create New Competition</flux:heading>

        @if (session()->has('message'))
            <flux:callout variant="success" :heading="session('message')" />
        @endif

        <form wire:submit="createCompetition">
            <flux:input wire:model="title" label="Competition Title" placeholder="Enter competition title..." required />

            <flux:textarea wire:model="description" label="Description" placeholder="Enter competition description..." />

            <flux:input type="file" wire:model="reference_image" label="Reference Image" required />

            @error('reference_image')
                <flux:error>{{ $message }}</flux:error>
            @enderror

            <flux:input wire:model="submission_deadline" label="Submission Deadline" type="datetime-local" required />

            <flux:input wire:model="voting_deadline" label="Voting Deadline" type="datetime-local" required />

            <flux:button type="submit" variant="primary">Create Competition</flux:button>
        </form>
    </flux:card>
</div>
