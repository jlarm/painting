<?php

use App\Models\Competition;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

it('sends voting notifications to users who submitted paintings', function () {
    Mail::fake();
    
    $competition = Competition::factory()->create([
        'submission_deadline' => now()->subDay(),
        'voting_notification_sent' => false,
    ]);
    
    $user = User::factory()->create();
    $user->submissions()->create([
        'competition_id' => $competition->id,
        'image_path' => 'test.jpg',
        'description' => 'Test submission',
    ]);
    
    $this->artisan('app:send-voting-notifications')
        ->expectsOutput('Voting notifications sent for competition: ' . $competition->title)
        ->expectsOutput('All voting notifications have been sent!')
        ->assertExitCode(0);
    
    // Assert that the competition was updated
    $competition->refresh();
    expect($competition->voting_notification_sent)->toBeTrue();
});

it('does not send voting notifications for competitions that are still open for submissions', function () {
    Mail::fake();
    
    $competition = Competition::factory()->create([
        'submission_deadline' => now()->addDay(),
        'voting_notification_sent' => false,
    ]);
    
    $this->artisan('app:send-voting-notifications')
        ->expectsOutput('All voting notifications have been sent!')
        ->assertExitCode(0);
    
    // Assert that the competition was not updated
    $competition->refresh();
    expect($competition->voting_notification_sent)->toBeFalse();
});
