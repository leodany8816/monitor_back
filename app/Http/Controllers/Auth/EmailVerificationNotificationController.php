<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class usuarioVerificationNotificationController extends Controller
{
    /**
     * Send a new usuario verification notification.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        if ($request->user()->hasVerifiedusuario()) {
            return redirect()->intended('/dashboard');
        }

        $request->user()->sendusuarioVerificationNotification();

        return response()->json(['status' => 'verification-link-sent']);
    }
}
