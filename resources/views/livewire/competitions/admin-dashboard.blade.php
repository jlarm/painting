<div>
    <flux:heading size="xl">Admin Competitions Dashboard</flux:heading>

    <flux:card class="mt-6">
        <flux:button wire:navigate href="{{ route('competitions.create') }}" icon="plus" variant="primary">
            Create New Competition
        </flux:button>

        @if($competitions->count() > 0)
            <flux:table class="mt-6">
                <flux:table.columns>
                    <flux:table.column sortable>#</flux:table.column>
                    <flux:table.column sortable>Title</flux:table.column>
                    <flux:table.column sortable>Submissions</flux:table.column>
                    <flux:table.column sortable>Submission Deadline</flux:table.column>
                    <flux:table.column sortable>Voting Deadline</flux:table.column>
                    <flux:table.column sortable>Status</flux:table.column>
                    <flux:table.column>Actions</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @foreach ($competitions as $competition)
                        <flux:table.row>
                            <flux:table.cell>{{ $competition->id }}</flux:table.cell>
                            <flux:table.cell>{{ $competition->title }}</flux:table.cell>
                            <flux:table.cell>{{ $competition->submissions_count }}</flux:table.cell>
                            <flux:table.cell>{{ $competition->submission_deadline->format('M j, Y') }}</flux:table.cell>
                            <flux:table.cell>{{ $competition->voting_deadline->format('M j, Y') }}</flux:table.cell>
                            <flux:table.cell>
                                @if ($competition->isVotingOpen())
                                    <flux:badge variant="success">Voting Open</flux:badge>
                                @elseif ($competition->isClosed())
                                    <flux:badge variant="danger">Voting Closed</flux:badge>
                                @else
                                    <flux:badge variant="info">Submissions Open</flux:badge>
                                @endif
                            </flux:table.cell>
                            <flux:table.cell>
                                <flux:button wire:navigate href="{{ route('competitions.show', $competition) }}" size="sm" variant="ghost">
                                    View
                                </flux:button>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>
        @else
            <div class="text-center py-12">
                <flux:icon name="trophy" variant="outline" class="mx-auto h-12 w-12 text-gray-400" />
                <flux:heading class="mt-4">No competitions yet</flux:heading>
                <flux:subheading>Create your first competition to get started</flux:subheading>
            </div>
        @endif
    </flux:card>
</div>
