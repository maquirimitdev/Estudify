<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class CustomUserProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials)) {
            return null;
        }

        $username = $credentials['email'] ?? null; // Get the email/username field

        return $this->createModel()
            ->where('email', $username)
            ->orWhere('username', $username)
            ->first();
    }
}
