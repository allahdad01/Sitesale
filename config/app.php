<?php

return [
    'name'      => $_ENV['APP_NAME'] ?? 'Al Moqadas Travel Agency',
    'env'       => $_ENV['APP_ENV'] ?? 'production',
    'debug'     => filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN),
    'url'       => $_ENV['APP_URL'] ?? 'http://localhost',
    'csrf'      => [
        'token_name' => '_csrf_token',
        'token_length' => 32,
    ],
    'session'   => [
        'lifetime'   => (int) ($_ENV['SESSION_LIFETIME'] ?? 120),
        'secure'     => true,
        'httponly'   => true,
        'samesite'   => 'Lax',
    ],
    'recaptcha' => [
        'site_key'   => $_ENV['RECAPTCHA_SITE_KEY'] ?? '',
        'secret_key' => $_ENV['RECAPTCHA_SECRET_KEY'] ?? '',
    ],
];
