<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientMessages extends Mailable
{
    use Queueable, SerializesModels;

	public $completeclient;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($completeclient)
    {
        //
        $this->completeclient=$completeclient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.client-messages');
    }
}
