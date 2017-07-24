<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Invite extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;
    public $gender;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invitation)
    {
        $this->invitation = $invitation;
        $this->gender = (substr($this->invitation->firstname, -1) == 'a' || substr($this->invitation->firstname, -1) == 'A' ? 'female' : 'male');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('kontakt@salespoint.pl')
                    ->subject('Skuteczna sprzedaż')
                    ->text('email.invite-plain');
    }
}
