<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable;

    public $name;
    public $email;
    public $message;


    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->messages = $data['messages'];
    }


    public function build()
    {
        return $this->subject('New Contact Message')
                    ->view('emails.contact')
                    ->with([
                        'name' => $this->name,
                        'email' => $this->email,
                        'messages' => $this->messages,
                    ]);
    }
}

