<?php

namespace App\Mail;

use App\Models\Reserva;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccionReservaMail extends Mailable
{
  use Queueable, SerializesModels;

  public $reserva;
  public $url;
  public $estado;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(Reserva $reserva, $url, $estado)
  {
    $this->reserva = $reserva;
    $this->url = $url;
    $this->estado = $estado;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->markdown('mails.accion-reserva');
  }
}
