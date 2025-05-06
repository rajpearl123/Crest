<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReply extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        // dd($data);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($data);
        return $this->subject($this->data['subject'])
                    ->view('admin.emails.contact_reply')
                    ->with([
                        'name' => $this->data['name'],
                        'message' => $this->data['message'],
                        'logoUrl' => $this->data['logoUrl'],
                    ]);
    }
}