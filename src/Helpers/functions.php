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
        $locale = $_SESSION['_locale'] ?? 'en';

        if ($locale !== 'en') {
            $localeKey = $key . '_' . $locale;
            $localeValue = \App\Models\Setting::get($localeKey);
            if ($localeValue !== null && $localeValue !== '') {
                return $localeValue;
            }
        }

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

if (!function_exists('__')) {
    function __(string $key, string $default = ''): string
    {
        $locale = $_SESSION['_locale'] ?? 'en';
        static $translations = [];

        if (!isset($translations[$locale])) {
            $file = __DIR__ . '/../../resources/lang/' . $locale . '.php';
            if (file_exists($file)) {
                $translations[$locale] = require $file;
            } else {
                $translations[$locale] = [];
            }
        }

        return $translations[$locale][$key] ?? ($default ?: $key);
    }
}

if (!function_exists('locale_dir')) {
    function locale_dir(): string
    {
        $locale = $_SESSION['_locale'] ?? 'en';
        return in_array($locale, ['ps', 'fa']) ? 'rtl' : 'ltr';
    }
}

if (!function_exists('locale_lang')) {
    function locale_lang(): string
    {
        $locale = $_SESSION['_locale'] ?? 'en';
        $map = ['en' => 'en', 'ps' => 'ps', 'fa' => 'fa'];
        return $map[$locale] ?? 'en';
    }
}

if (!function_exists('locale_col')) {
    function locale_col(string $field): string
    {
        $locale = $_SESSION['_locale'] ?? 'en';
        return $field . '_' . $locale;
    }
}

if (!function_exists('locale_val')) {
    function locale_val(array $row, string $field, string $default = ''): string
    {
        $locale = $_SESSION['_locale'] ?? 'en';
        $localeCol = $field . '_' . $locale;
        if (isset($row[$localeCol]) && $row[$localeCol] !== '' && $row[$localeCol] !== null) {
            return $row[$localeCol];
        }
        if (isset($row[$field]) && $row[$field] !== '' && $row[$field] !== null) {
            return $row[$field];
        }
        return $default;
    }
}

if (!function_exists('locale_val_e')) {
    function locale_val_e(array $row, string $field, string $default = ''): string
    {
        return e(locale_val($row, $field, $default));
    }
}
