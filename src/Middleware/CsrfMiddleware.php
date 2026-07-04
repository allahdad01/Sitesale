<?php

namespace App\Middleware;

use App\Core\Request;
use App\Core\Session;

class CsrfMiddleware
{
    public function handle(Request $request): void
    {
        if ($request->method() !== 'POST') {
            return;
        }

        $token = $request->post('_csrf_token');
        $stored = Session::get('_csrf_token');

        if (!$token || !$stored || !hash_equals($stored, $token)) {
            http_response_code(419);
            die('CSRF token mismatch. Please go back and try again.');
        }
    }
}
