<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    public function dispatch(string $uri, string $method, array $routes, array $data = []): void
    {
        // Normalize URI (remove trailing slash except for root)
        $basePath = '/questboard/public';

        if (str_starts_with($uri, $basePath)) {
            $uri = substr($uri, strlen($basePath));
        }

        $cleanUri = rtrim($uri, '/') ?: '/';

        foreach ($routes as $route) {
            if ($route['uri'] === $cleanUri && $route['method'] === $method) {
                extract($data);
                if (isset($route['controller_method'])) {
                    $controller->{$route['controller_method']}();
                } elseif (isset($route['action'])) {
                    require_once $route['action'];
                }
                return;
            }
        }
        http_response_code(404);
        echo '<h1>404 - Page Not Found</h1>';
    }
}