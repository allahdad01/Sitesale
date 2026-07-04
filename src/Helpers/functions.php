<?php

if (!function_exists('e')) {
    function e(mixed $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

if (!function_exists('csrf_token')) {
    function csrf_token(): string
    {
        $token = \App\Core\Session::get('_csrf_token');

        if (!$token) {
            $token = bin2hex(random_bytes(32));
            \App\Core\Session::set('_csrf_token', $token);
        }

        return $token;
    }
}

if (!function_exists('csrf_field')) {
    function csrf_field(): string
    {
        return '<input type="hidden" name="_csrf_token" value="' . csrf_token() . '">';
    }
}

if (!function_exists('old')) {
    function old(string $key, string $default = ''): string
    {
        return \App\Core\Session::get('_old_input.' . $key, $default);
    }
}

if (!function_exists('base_url')) {
    function base_url(string $path = ''): string
    {
        $baseUrl = $_ENV['APP_URL'] ?? '';
        if (!empty($baseUrl)) {
            return rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
        }
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
        $basePath = str_replace('\\', '/', $scriptDir);
        return rtrim($basePath, '/') . '/' . ltrim($path, '/');
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        return base_url($path);
    }
}

if (!function_exists('config')) {
    function config(string $key, mixed $default = null): mixed
    {
        $parts = explode('.', $key);
        $file  = array_shift($parts);
        $path  = __DIR__ . '/../../config/' . $file . '.php';

        if (!file_exists($path)) {
            return $default;
        }

        $config = require $path;

        foreach ($parts as $part) {
            if (!is_array($config) || !array_key_exists($part, $config)) {
                return $default;
            }
            $config = $config[$part];
        }

        return $config;
    }
}

if (!function_exists('statusBadge')) {
    function statusBadge(string $status): string
    {
        $map = [
            'pending'  => ['label' => 'Pending',  'class' => 'badge-warning'],
            'read'     => ['label' => 'Read',     'class' => 'badge-neutral'],
            'replied'  => ['label' => 'Replied',  'class' => 'badge-success'],
        ];
        $entry = $map[$status] ?? ['label' => ucfirst($status), 'class' => 'badge-neutral'];
        return '<span class="badge ' . $entry['class'] . '">' . e($entry['label']) . '</span>';
    }
}

if (!function_exists('setting')) {
    function setting(string $key, mixed $default = null): string|null
    {
        return \App\Models\Setting::get($key, $default);
    }
}

if (!function_exists('is_current_path')) {
    function is_current_path(string $path): bool
    {
        $current = $_SERVER['REQUEST_URI'] ?? '/';
        $current = parse_url($current, PHP_URL_PATH);
        return rtrim($current, '/') === rtrim($path, '/');
    }
}
