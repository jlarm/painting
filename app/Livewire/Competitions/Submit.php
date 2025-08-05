<?php

namespace App\Livewire\Competitions;

use App\Models\Competition;
use App\Models\Submission;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Submit extends Component
{
    use WithFileUploads;

    public Competition $competition;
    public $image;
    public $description;

    protected $rules = [
        'image' => 'required|image|max:10240', // 10MB Max
        'description' => 'nullable|string|max:1000',
    ];

    public function mount(Competition $competition)
    {
        $this->competition = $competition;
    }

    public function submitPainting()
    {
        // Check if submission is still open
        if (! $this->competition->isSubmissionOpen()) {
            session()->flash('error', 'Submission deadline has passed.');
            return;
        }

        $this->validate();

        // Check if user already submitted
        if (Submission::where('competition_id', $this->competition->id)
            ->where('user_id', auth()->id())
            ->exists()) {
            session()->flash('error', 'You have already submitted to this competition.');
            return;
        }

        $imagePath = $this->image->store('competition-submissions', 'public');

        Submission::create([
            'competition_id' => $this->competition->id,
            'user_id' => auth()->id(),
            'image_path' => $imagePath,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Your submission was successful!');

        return redirect()->route('competitions.show', $this->competition);
    }

    public function render()
    {
        return view('livewire.competitions.submit');
    }
}
