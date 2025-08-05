<?php

use App\Mail\VotingNotification;
use App\Models\Competition;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('renders the voting notification email', function () {
    $competition = Competition::factory()->create([
        'title' => 'Test Competition',
    ]);
    
    $mail = new VotingNotification($competition);
    $mail->assertSeeInText('Time to Vote - Test Competition');
    $mail->assertSeeInHtml('Time to Vote - Test Competition');
});
