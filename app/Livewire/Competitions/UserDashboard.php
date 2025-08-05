<?php

namespace App\Livewire\Competitions;

use App\Models\Competition;
use Livewire\Component;

class UserDashboard extends Component
{
    public function render()
    {
        // Get active competitions (open for submissions or voting)
        $activeCompetitions = Competition::where('is_active', true)
            ->where(function ($query) {
                $query->where('submission_deadline', '>', now())
                    ->orWhere('voting_deadline', '>', now());
            })
            ->orderBy('submission_deadline', 'asc')
            ->get();

        // Get past competitions (closed)
        $pastCompetitions = Competition::where('is_active', true)
            ->where('submission_deadline', '<=', now())
            ->where('voting_deadline', '<=', now())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.competitions.user-dashboard', compact('activeCompetitions', 'pastCompetitions'));
    }
}
