<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    // Login del usuario
    Fortify::authenticateUsing(function (Request $request) {
      $request->validate([
        'ci' => 'required|string',
        'password' => 'required|string',
      ]);

      // Autenticacion con correo o ci
      $user = User::where('ci', $request->ci)
        ->orWhere('correo', $request->ci)
        ->first();

      if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
          'ci' => ['Las credenciales no son correctas'],
        ]);
      }

      $user->createToken($request->ci);

      return $user;
    });

    Fortify::createUsersUsing(CreateNewUser::class);
    // Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
    // Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
    Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

    RateLimiter::for('login', function (Request $request) {
      return Limit::perMinute(5)->by($request->email . $request->ip());
    });

    RateLimiter::for('two-factor', function (Request $request) {
      return Limit::perMinute(5)->by($request->session()->get('login.id'));
    });
  }
}
