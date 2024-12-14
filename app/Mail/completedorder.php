<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class completedorder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $nameproduct;
    public $date;
    public $address;
    public function __construct($nameproduct, $date, $address)
    {
        $this->nameproduct = $nameproduct;
        $this->date = $date;
        $this->address = $address;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Completedorder',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.completedorder',
        );
    }

    public function build()
    {
        return $this->markdown('emails.completedorder')
            ->subject('Order Confirmation')
            ->with([
                'nameproduct' => $this->nameproduct,
                'date' => $this->date,
                'address' => $this->address,
            ]);
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
