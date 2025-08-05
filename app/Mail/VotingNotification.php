<?php

namespace App\Mail;

use App\Models\Competition;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VotingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public Competition $competition;

    public function __construct(Competition $competition)
    {
        $this->competition = $competition;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Time to Vote - ' . $this->competition->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.voting-notification',
            with: [
                'competition' => $this->competition,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
