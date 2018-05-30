<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HostingEnds extends Mailable
{
    use Queueable, SerializesModels;

    public $hosting;
    public $hostingCyclePrevious;
    public $hostingCycleNext;
    public $invoice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($hosting, $hostingCyclePrevious, $hostingCycleNext, $invoice)
    {
        $this->hosting = $hosting;
        $this->hostingCyclePrevious = $hostingCyclePrevious;
        $this->hostingCycleNext = $hostingCycleNext;
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Koniec okresu abonamentowego hostingu')
                    ->view('email.hosting-ends')
                    ->text('email.hosting-ends-plain')
                    ->attach(storage_path('app/docs/'.str_replace('/', '_', $this->invoice->invoice_number.'.pdf')));
    }
}
