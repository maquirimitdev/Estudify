<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class BruteForceProtection
{
    protected $maxAttempts = 5;
    protected $lockoutDuration = 900; // 15 minutes in seconds
    protected $captchaThreshold = 3; // Show CAPTCHA after 3 failed attempts

    public function getAttempts(string $identifier): int
    {
        return Cache::get($this->getAttemptsKey($identifier), 0);
    }

    public function incrementAttempts(string $identifier): int
    {
        $key = $this->getAttemptsKey($identifier);
        $attempts = Cache::get($key, 0) + 1;
        Cache::put($key, $attempts, $this->lockoutDuration);
        return $attempts;
    }

    public function resetAttempts(string $identifier): void
    {
        Cache::forget($this->getAttemptsKey($identifier));
    }

    public function isLockedOut(string $identifier): bool
    {
        return $this->getAttempts($identifier) >= $this->maxAttempts;
    }

    public function shouldShowCaptcha(string $identifier): bool
    {
        return $this->getAttempts($identifier) >= $this->captchaThreshold;
    }

    public function getTimeoutDuration(string $identifier): int
    {
        $attempts = $this->getAttempts($identifier);
        return max(0, $this->lockoutDuration - (now()->timestamp - Cache::get($this->getAttemptsKey($identifier) . '_timestamp', now()->timestamp)));
    }

    protected function getAttemptsKey(string $identifier): string
    {
        return 'login_attempts_' . hash('sha256', $identifier);
    }
}
