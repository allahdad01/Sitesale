<?php

namespace App\Core;

class Request
{
    private array $params = [];

    public function method(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function uri(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $scriptDir = rtrim(dirname($scriptName), '/');
        if (basename($scriptDir) === 'public') {
            $scriptDir = dirname($scriptDir);
        }

        if ($scriptDir !== '' && $scriptDir !== '/' && str_starts_with($uri, $scriptDir)) {
            $uri = substr($uri, strlen($scriptDir)) ?: '/';
        }

        return $uri;
    }

    public function isPost(): bool
    {
        return $this->method() === 'POST';
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $_GET[$key] ?? $default;
    }

    public function post(string $key, mixed $default = null): mixed
    {
        return $_POST[$key] ?? $default;
    }

    public function all(): array
    {
        return $this->isPost() ? $_POST : $_GET;
    }

    public function param(string $key, mixed $default = null): mixed
    {
        return $this->params[$key] ?? $default;
    }

    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    public function ip(): string
    {
        $headers = [
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_REAL_IP',
            'REMOTE_ADDR',
        ];

        foreach ($headers as $h) {
            if (!empty($_SERVER[$h])) {
                $ips = explode(',', $_SERVER[$h]);
                return trim($ips[0]);
            }
        }

        return '0.0.0.0';
    }
}
