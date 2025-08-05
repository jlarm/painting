<?php

namespace App\Livewire\Competitions;

use App\Models\Competition;
use App\Models\Submission;
use App\Models\Vote as VoteModel;
use Livewire\Component;

class Vote extends Component
{
    public Competition $competition;
    public $submissions = [];
    public $selectedSubmission = null;

    public function mount(Competition $competition)
    {
        $this->competition = $competition;
        
        // Check if voting is open
        if (! $competition->isVotingOpen()) {
            session()->flash('error', 'Voting is not currently open for this competition.');
            return redirect()->route('competitions.show', $competition);
        }
        
        // Get submissions for this competition
        $this->submissions = $competition->submissions()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function voteForSubmission(Submission $submission)
    {
        // Check if voting is open
        if (! $this->competition->isVotingOpen()) {
            session()->flash('error', 'Voting is not currently open for this competition.');
            return;
        }

        // Check if user has already voted
        if (VoteModel::where('competition_id', $this->competition->id)
            ->where('voter_id', auth()->id())
            ->exists()) {
            session()->flash('error', 'You have already voted in this competition.');
            return;
        }

        VoteModel::create([
            'competition_id' => $this->competition->id,
            'voter_id' => auth()->id(),
            'submission_id' => $submission->id,
        ]);

        session()->flash('message', 'Your vote has been recorded!');

        return redirect()->route('competitions.show', $this->competition);
    }

    public function render()
    {
        return view('livewire.competitions.vote');
    }
}
