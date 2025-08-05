<?php

namespace App\Livewire\Competitions;

use App\Models\Competition;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function mount()
    {
        if (!auth()->user()?->isAdmin()) {
            abort(403);
        }
    }

    public function render()
    {
        $competitions = Competition::withCount('submissions')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.competitions.admin-dashboard', compact('competitions'));
    }
}
