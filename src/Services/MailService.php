<?php

namespace App\Services;

class MailService
{
    public static function send(string $to, string $subject, string $body): bool
    {
        $config = require __DIR__ . '/../../config/mail.php';

        if (empty($config['host'])) {
            return false;
        }

        $headers = [
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $config['from_name'] . ' <' . $config['from_address'] . '>',
            'Reply-To: ' . $config['from_address'],
            'X-Mailer: PHP/' . PHP_VERSION,
        ];

        return mail($to, $subject, $body, implode("\r\n", $headers));
    }
}
