<?php

namespace App\Email;

use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class InvoiceEmail extends Mailable
{
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private string $url)
    {
        //
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */

    public function envelope()
    {
        return new Envelope(
            subject: 'Invoices',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */

    public function content()
    {
        return new Content(
            htmlString: 'This is an invoice',
        );
    }

    /**
     * Get the attachments for the message.
     *
     */
    public function attachments()
    {
        return Attachment::fromUrl($this->url)
            ->as('invoice.pdf')
            ->withMime('application/pdf');
    }
}
