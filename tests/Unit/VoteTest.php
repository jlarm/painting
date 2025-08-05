<?php

use App\Models\Competition;
use App\Models\Submission;
use App\Models\User;
use App\Models\Vote;

it('belongs to a competition', function () {
    $vote = Vote::factory()->create();
    expect($vote->competition)->toBeInstanceOf(Competition::class);
});

it('belongs to a voter', function () {
    $vote = Vote::factory()->create();
    expect($vote->voter)->toBeInstanceOf(User::class);
});

it('belongs to a submission', function () {
    $vote = Vote::factory()->create();
    expect($vote->submission)->toBeInstanceOf(Submission::class);
});
