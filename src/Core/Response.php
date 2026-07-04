<?php

namespace App\Core;

class Response
{
    public static function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public static function redirect(string $url, int $status = 302): void
    {
        http_response_code($status);
        header('Location: ' . $url);
        exit;
    }

    public static function setSecurityHeaders(): void
    {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');

        if (!empty($_ENV['APP_URL'])) {
            $domain = parse_url($_ENV['APP_URL'], PHP_URL_HOST);
            header("Content-Security-Policy: default-src 'self' https://fonts.googleapis.com https://fonts.gstatic.com https://cdnjs.cloudflare.com https://commons.wikimedia.org 'unsafe-inline' 'unsafe-eval'; img-src 'self' https://commons.wikimedia.org data:; connect-src 'self';");
        }
    }
}
