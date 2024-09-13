<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use \App\Models\Usuario;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?usuario={$notifiable->getusuarioForPasswordReset()}";
        });

        // Validator::extend('usuario', function($attribute, $value, $parameters, $validator) {
        //     $user = Usuario::where('usuario', $value)->first();
        //     return $user && $user->active;  // Asegurarse de que el usuario esté activo
        // });
    }
}
