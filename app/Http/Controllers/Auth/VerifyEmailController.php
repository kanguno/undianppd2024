<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
{
    \Log::info('User before verification:', ['user' => $request->user()]);

    if ($request->user()->hasVerifiedEmail()) {
        \Log::info('User email already verified:', ['user' => $request->user()]);
        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }

    if ($request->user()->markEmailAsVerified()) {
        \Log::info('User email marked as verified:', ['user' => $request->user()]);
        event(new Verified($request->user()));
    }

    \Log::info('Verification failed:', ['user' => $request->user()]);
    return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
}

}
