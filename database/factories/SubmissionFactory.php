<?php

namespace Database\Factories;

use App\Models\Competition;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubmissionFactory extends Factory
{
    protected $model = Submission::class;

    public function definition()
    {
        return [
            'competition_id' => Competition::factory(),
            'user_id' => User::factory(),
            'image_path' => 'competition-submissions/' . $this->faker->uuid() . '.jpg',
            'description' => $this->faker->paragraph(),
        ];
    }
}
