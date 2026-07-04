<?php

return [
    'host'        => $_ENV['MAIL_HOST'] ?? '',
    'port'        => (int) ($_ENV['MAIL_PORT'] ?? 587),
    'username'    => $_ENV['MAIL_USER'] ?? '',
    'password'    => $_ENV['MAIL_PASS'] ?? '',
    'encryption'  => $_ENV['MAIL_ENCRYPTION'] ?? 'tls',
    'from_address' => $_ENV['MAIL_FROM_ADDRESS'] ?? 'noreply@almoqadas.com',
    'from_name'   => $_ENV['MAIL_FROM_NAME'] ?? 'Al Moqadas Travel Agency',
];
