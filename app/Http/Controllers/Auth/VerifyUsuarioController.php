<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\usuarioVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyusuarioController extends Controller
{
    /**
     * Mark the authenticated user's usuario address as verified.
     */
    public function __invoke(usuarioVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedusuario()) {
            return redirect()->intended(
                config('app.frontend_url').'/dashboard?verified=1'
            );
        }

        if ($request->user()->markusuarioAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(
            config('app.frontend_url').'/dashboard?verified=1'
        );
    }
}
