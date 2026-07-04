<?php

namespace App\Core;

class App
{
    public static function boot(): void
    {
        self::loadEnv();
        self::handleErrors();

        Session::start();
        Response::setSecurityHeaders();
    }

    private static function loadEnv(): void
    {
        $envFile = __DIR__ . '/../../.env';

        if (!file_exists($envFile)) {
            return;
        }

        foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            if (str_starts_with(trim($line), '#')) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);
            $key   = trim($key);
            $value = trim($value);

            if (!array_key_exists($key, $_ENV)) {
                $_ENV[$key] = $value;
                putenv("{$key}={$value}");
            }
        }
    }

    private static function handleErrors(): void
    {
        $debug = filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN);

        if ($debug) {
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
        } else {
            error_reporting(0);
            ini_set('display_errors', '0');
        }

        set_exception_handler(function (\Throwable $e) use ($debug) {
            $logFile = __DIR__ . '/../../storage/logs/error.log';
            $message = '[' . date('Y-m-d H:i:s') . '] ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . "\n" . $e->getTraceAsString() . "\n\n";
            @file_put_contents($logFile, $message, FILE_APPEND);

            http_response_code(500);

            if ($debug) {
                echo '<h1>500 Internal Server Error</h1>';
                echo '<p><strong>' . e($e->getMessage()) . '</strong></p>';
                echo '<pre>' . e($e->getTraceAsString()) . '</pre>';
            } else {
                View::render('errors/500', ['title' => 'Server Error'], 'main');
            }

            exit;
        });
    }
}
