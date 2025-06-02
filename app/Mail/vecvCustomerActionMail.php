<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class vecvCustomerActionMail extends Mailable
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
        return $this->from('vecv@feedback.com', 'Vecv')
            ->subject(' Status - Customer Action : '.$this->details['ticket_id'].' ( '.$this->details['ticket_desc'].' )')
            ->view('mails.vecvCustomerAction',['details' => $this->details]);
    }
}
