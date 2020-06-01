<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAppointmentMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $appointment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $appointment)
    {
        $this->user = $user;
        $this->appointment = $appointment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nouveau rendez-vous')->markdown('emails.NewAppointment', ['user' => $this->user, 'appointment' => $this->appointment]);
    }
}
