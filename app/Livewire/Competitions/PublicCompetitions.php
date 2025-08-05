<?php

namespace App\Livewire\Competitions;

use App\Models\Competition;
use Livewire\Component;

class PublicCompetitions extends Component
{
    public function render()
    {
        $activeCompetitions = Competition::where('submission_deadline', '>', now())
            ->orWhere(function ($query) {
                $query->where('submission_deadline', '<=', now())
                      ->where('voting_deadline', '>', now());
            })
            ->withCount('submissions')
            ->orderBy('created_at', 'desc')
            ->get();

        $pastCompetitions = Competition::where('voting_deadline', '<', now())
            ->withCount('submissions')
            ->orderBy('voting_deadline', 'desc')
            ->get();

        return view('public.competitions', [
            'activeCompetitions' => $activeCompetitions,
            'pastCompetitions' => $pastCompetitions,
        ])->layout('components.layouts.public');
    }
}
