<?php

namespace App\Livewire\Competitions;

use App\Models\Competition;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        $competitions = Competition::where('admin_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.competitions.admin-dashboard', compact('competitions'));
    }
}
