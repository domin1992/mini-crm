<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Faktura '.$this->invoice->invoice_number)
                    ->view('email.invoice-created')
                    ->text('email.invoice-created-plain')
                    ->attach(storage_path('app/docs/'.str_replace('/', '_', $this->invoice->invoice_number.'.pdf')));
    }
}
