<?php

namespace App\Core;

class Router
{
    private array $routes = [];
    private array $middleware = [];

    public function get(string $path, array $handler, array $middleware = []): void
    {
        $this->addRoute('GET', $path, $handler, $middleware);
    }

    public function post(string $path, array $handler, array $middleware = []): void
    {
        $this->addRoute('POST', $path, $handler, $middleware);
    }

    private function addRoute(string $method, string $path, array $handler, array $middleware = []): void
    {
        $pattern = preg_replace('/\{([a-zA-Z_]+)\}/', '(?P<$1>[^/]+)', $path);
        $pattern = '#^' . $pattern . '$#';

        $this->routes[] = [
            'method'    => $method,
            'pattern'   => $pattern,
            'handler'   => $handler,
            'middleware' => $middleware,
        ];
    }

    public function addMiddleware(string $class): void
    {
        $this->middleware[] = $class;
    }

    public function dispatch(Request $request): void
    {
        $method = $request->method();
        $uri    = $request->uri();

        foreach ($this->middleware as $mw) {
            (new $mw)->handle($request);
        }

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            if (preg_match($route['pattern'], $uri, $matches)) {
                $params = array_filter($matches, fn($k) => is_string($k), ARRAY_FILTER_USE_KEY);
                $request->setParams($params);

                foreach ($route['middleware'] as $mw) {
                    (new $mw)->handle($request);
                }

                [$controllerClass, $action] = $route['handler'];
                $controller = new $controllerClass();
                $controller->$action($request);

                return;
            }
        }

        $this->notFound();
    }

    private function notFound(): void
    {
        http_response_code(404);
        View::render('errors/404', ['title' => 'Page Not Found'], 'main');
    }
}
