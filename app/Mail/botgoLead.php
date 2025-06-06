<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class botgoLead extends Mailable
{
    use Queueable, SerializesModels;
    protected $details;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
      $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('pr@botgo.io', 'Botgo')
            ->subject('Urgent: Botgo New Lead !!')
            ->view('mails.botgoLeadTemplate',['details' => $this->details]);
    }
}
