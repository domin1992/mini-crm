<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BillCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $bill;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bill)
    {
        $this->bill = $bill;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Rachunek '.$this->bill->bill_number)
                    ->view('email.bill-created')
                    ->text('email.bill-created-plain')
                    ->attach(storage_path('app/docs/'.str_replace('/', '_', $this->bill->bill_number.'.pdf')));
    }
}
