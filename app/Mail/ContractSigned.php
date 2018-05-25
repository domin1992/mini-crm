<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContractSigned extends Mailable
{
    use Queueable, SerializesModels;

    public $contract;
    public $owner;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contract, $owner)
    {
        $this->contract = $contract;
        $this->owner = $owner;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->contract->type()->first()->name)
                    ->view('email.contract-signed')
                    ->text('email.contract-signed-plain')
                    ->attach(storage_path('app/docs/').$this->contract->slug.'.pdf', [
                        'as' => str_slug($this->owner->name).'-'.$this->contract->type()->first()->slug.'.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}
