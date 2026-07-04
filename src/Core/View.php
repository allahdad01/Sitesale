<?php

namespace App\Core;

class View
{
    private static string $basePath = __DIR__ . '/../../resources';

    public static function render(string $view, array $data = [], string $layout = 'main'): void
    {
        extract($data);

        $viewPath = self::$basePath . '/views/' . str_replace('.', '/', $view) . '.php';

        if (!file_exists($viewPath)) {
            throw new \RuntimeException("View not found: {$view}");
        }

        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        $layoutPath = self::$basePath . '/layouts/' . $layout . '.php';

        if ($layout && file_exists($layoutPath)) {
            require $layoutPath;
        } else {
            echo $content;
        }
    }

    public static function partial(string $partial, array $data = []): void
    {
        extract($data);
        $path = self::$basePath . '/partials/' . str_replace('.', '/', $partial) . '.php';

        if (file_exists($path)) {
            require $path;
        }
    }
}
