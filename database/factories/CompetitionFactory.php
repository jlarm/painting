<?php

namespace Database\Factories;

use App\Models\Competition;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompetitionFactory extends Factory
{
    protected $model = Competition::class;

    public function definition()
    {
        return [
            'admin_id' => User::factory(),
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'reference_image_path' => 'competition-reference-images/' . fake()->uuid() . '.jpg',
            'submission_deadline' => now()->addDays(7),
            'voting_deadline' => now()->addDays(14),
            'is_active' => true,
        ];
    }
}
