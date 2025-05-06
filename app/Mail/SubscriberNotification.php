<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Utils\ViewPath;

class SubscriberNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;
    public $logoUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($subscriber, $logoUrl)
    {
        $this->subscriber = $subscriber;
        $this->logoUrl = $logoUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Subscriber Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: ViewPath::SUBSCRIBER_NOTIFICATION,
            with: [
                'subscriber' => $this->subscriber,
                'logoUrl' => $this->logoUrl,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
