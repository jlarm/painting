<?php

use App\Models\Competition;
use App\Models\Submission;
use App\Models\User;

it('belongs to a user', function () {
    $submission = Submission::factory()->create();
    expect($submission->user)->toBeInstanceOf(User::class);
});

it('belongs to a competition', function () {
    $submission = Submission::factory()->create();
    expect($submission->competition)->toBeInstanceOf(Competition::class);
});

it('can count votes', function () {
    $submission = Submission::factory()->create();
    expect($submission->voteCount())->toBeInt();
});
