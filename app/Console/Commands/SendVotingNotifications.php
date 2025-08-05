<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Competition;
use App\Models\User;
use App\Mail\VotingNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class SendVotingNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-voting-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send voting notifications to users when submission period ends';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all competitions where submission deadline has passed but voting notification hasn't been sent yet
        $competitions = Competition::where('submission_deadline', '<=', now())
            ->where('voting_notification_sent', false)
            ->get();

        foreach ($competitions as $competition) {
            // Get all users who submitted paintings for this competition
            $users = User::whereHas('submissions', function ($query) use ($competition) {
                $query->where('competition_id', $competition->id);
            })->get();

            // Send email to each user
            foreach ($users as $user) {
                Mail::to($user)->send(new VotingNotification($competition));
            }

            // Mark that notifications have been sent
            $competition->update(['voting_notification_sent' => true]);

            $this->info("Voting notifications sent for competition: {$competition->title}");
        }

        $this->info('All voting notifications have been sent!');
    }
}
