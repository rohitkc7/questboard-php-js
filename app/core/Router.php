<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    public function dispatch(string $uri, string $method, array $routes): void
    {
        $basePath = '/questboard/public';
        $cleanUri = str_replace($basePath, '', $uri);

        if ($cleanUri == '') {
            $cleanUri = '/';
        }

        foreach ($routes as $route) {
            if ($route['uri'] === $cleanUri && $route['method'] == $method) {
                require_once $route['action'];
                return;
            }
        }
        http_response_code(404);
        echo '<h4> 404 - Page not found</h4>';
    }
}