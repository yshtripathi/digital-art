<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
     public function __construct($order) {
        $this->order= $order;
    }

     public function build() {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Order Confirmation !!!')
                    ->view('emails.order')
                     ->with(['order' => $this->order]);
    }

    

    /**
     * Get the message content definition.
     */
    

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
