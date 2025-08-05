<?php

namespace App\Livewire\Competitions;

use App\Models\Competition;
use App\Models\Submission;
use App\Models\Vote;
use Livewire\Component;

class Show extends Component
{
    public Competition $competition;
    public $userHasSubmitted = false;
    public $userHasVoted = false;

    public function mount(Competition $competition)
    {
        $this->competition = $competition;
        $this->userHasSubmitted = Submission::where('competition_id', $competition->id)
            ->where('user_id', auth()->id())
            ->exists();
        
        if ($competition->isVotingOpen() || $competition->isClosed()) {
            $this->userHasVoted = Vote::where('competition_id', $competition->id)
                ->where('voter_id', auth()->id())
                ->exists();
        }
    }

    public function render()
    {
        $submissions = $this->competition->submissions()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.competitions.show', compact('submissions'));
    }
}
