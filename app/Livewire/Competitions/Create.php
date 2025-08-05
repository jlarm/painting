<?php

namespace App\Livewire\Competitions;

use App\Models\Competition;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $reference_image;
    public $submission_deadline;
    public $voting_deadline;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'reference_image' => 'required|image|max:10240', // 10MB Max
        'submission_deadline' => 'required|date|after:today',
        'voting_deadline' => 'required|date|after:submission_deadline',
    ];

    public function createCompetition()
    {
        $this->validate();

        $imagePath = $this->reference_image->store('competition-reference-images', 'public');

        Competition::create([
            'admin_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'reference_image_path' => $imagePath,
            'submission_deadline' => $this->submission_deadline,
            'voting_deadline' => $this->voting_deadline,
            'is_active' => true,
        ]);

        session()->flash('message', 'Competition created successfully.');

        $this->reset(['title', 'description', 'reference_image', 'submission_deadline', 'voting_deadline']);

        return redirect()->route('competitions.admin');
    }

    public function mount()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }
    }

    public function render()
    {
        return view('livewire.competitions.create');
    }
}
