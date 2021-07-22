<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyStudentSetStudentSectionMail extends Mailable
{
    use Queueable, SerializesModels;
    private $informacion;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($informacion)
    {
        $this->informacion = $informacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Actividades realizadas en Prácticas Pre Profesionales')
            ->markdown('emails.student.setStudentSection')
            ->with(['informacion'=>$this->informacion,]);
    }
}
