<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    if ($this->app->environment('local')) {
      $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
      $this->app->register(TelescopeServiceProvider::class);
    }
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    // Elimina "data" de las respuestas JSON del usuario
    \App\Http\Resources\UserResource::withoutWrapping();

    // Crea el link de validacion de correo al registrarse
    // VerifyEmail::createUrlUsing(function ($notifiable) {
    //   $url = URL::temporarySignedRoute(
    //     'verification.verify',
    //     now()->addMinutes(60),
    //     [
    //       'id'   => $notifiable->getKey(),
    //       'hash' => sha1($notifiable->getEmailForVerification()),
    //     ],
    //     false
    //   );
    //   $spa = config('app.spa');
    //   return  "{$spa}/{$url}";
    // });
  }
}
