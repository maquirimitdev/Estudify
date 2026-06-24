<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}

// Redirect to MFA verification if enabled
Route::middleware('auth')->get('/verify-mfa', function () {
    if (auth()->user()->two_factor_enabled && !session('mfa_verified')) {
        return view('auth.verify-mfa');
    }
    return redirect('/dashboard');
});
