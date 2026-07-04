<?php

namespace App\Middleware;

use App\Core\Request;
use App\Core\Session;

class RateLimitMiddleware
{
    private int $maxAttempts = 5;
    private int $decayMinutes = 15;

    public function handle(Request $request): void
    {
        if ($request->method() !== 'POST') {
            return;
        }

        $ip  = $request->ip();
        $key = '_rate_limit_' . md5($ip);
        $now = time();

        $attempts = Session::get($key, []);

        $attempts = array_filter($attempts, fn($t) => $t > $now - ($this->decayMinutes * 60));

        if (count($attempts) >= $this->maxAttempts) {
            http_response_code(429);
            die('Too many requests. Please try again later.');
        }

        $attempts[] = $now;
        Session::set($key, $attempts);
    }
}
