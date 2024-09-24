<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequestst;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's usuario address as verified.
     */
    public function __invoke(EmailVerificationRequestst $request): RedirectResponse
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
