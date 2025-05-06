<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;
use App\Models\Transaction;
use App\Models\Theater;
use App\Models\Addon;
use App\Models\Cakes;
use App\Models\Events;
use App\Utils\ViewPath;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    

    /**
     * Create a new message instance.
     *
     * @param object $user
     * @param Booking $booking
     * @param Transaction $transaction
     * @param Theater $theater
     * @param object|null $decoration
     * @param \Illuminate\Database\Eloquent\Collection $addons
     * @param Cakes|null $cake
     */
    public function __construct($booking)
    {
        $this->booking = $booking; 
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation - PARTYSCAPE',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    public function content(): Content
    {
        return new Content(
            view: ViewPath::BOOKING_CONFIRMATION,
        );
    }
}
