<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservaPendienteMail extends Mailable
{
  use Queueable, SerializesModels;

  public $reserva;
  public $url;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($reserva, $url)
  {
    $this->reserva = $reserva;
    $this->url = $url;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->markdown('mails.reserva-pendiente');
  }
}
