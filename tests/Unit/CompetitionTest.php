<?php

use App\Models\Competition;
use App\Models\User;

it('belongs to an admin user', function () {
    $competition = Competition::factory()->create();
    expect($competition->admin)->toBeInstanceOf(User::class);
});

it('can have submissions', function () {
    $competition = Competition::factory()->create();
    expect($competition->submissions)->not->toBeNull();
});

it('can determine if submission is open', function () {
    $competition = Competition::factory()->create([
        'submission_deadline' => now()->addDay(),
    ]);
    
    expect($competition->isSubmissionOpen())->toBeTrue();
});

it('can determine if submission is closed', function () {
    $competition = Competition::factory()->create([
        'submission_deadline' => now()->subDay(),
    ]);
    
    expect($competition->isSubmissionOpen())->toBeFalse();
});

it('can determine if voting is open', function () {
    $competition = Competition::factory()->create([
        'submission_deadline' => now()->subDay(),
        'voting_deadline' => now()->addDay(),
    ]);
    
    expect($competition->isVotingOpen())->toBeTrue();
});

it('can determine if competition is closed', function () {
    $competition = Competition::factory()->create([
        'submission_deadline' => now()->subWeek(),
        'voting_deadline' => now()->subDay(),
    ]);
    
    expect($competition->isClosed())->toBeTrue();
});
