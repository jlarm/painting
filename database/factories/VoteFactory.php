<?php

namespace Database\Factories;

use App\Models\Competition;
use App\Models\Submission;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoteFactory extends Factory
{
    protected $model = Vote::class;

    public function definition()
    {
        return [
            'competition_id' => Competition::factory(),
            'voter_id' => User::factory(),
            'submission_id' => Submission::factory(),
        ];
    }
}
