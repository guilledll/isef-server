<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UsuarioAprobadoMail extends Mailable
{
  use Queueable, SerializesModels;

  public $user;
  public $url;

  /**
   * Create a new message instance.
   *
   * @param User $user
   * @param String $url
   * @return void
   */
  public function __construct(User $user, $url)
  {
    $this->user = $user;
    $this->url = $url;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->markdown('mails.usuario-aprobado');
  }
}
