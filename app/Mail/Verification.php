<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Verification extends Mailable
{
    use Queueable, SerializesModels;

    public $type;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $type = $this->type;
        return $this->view('mail.index',['type'=>$type]);
    }
}
