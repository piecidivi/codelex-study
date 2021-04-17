<?php

namespace Bootstrap;

use App\Controllers\ErrorController;
use FastRoute\Dispatcher;
use League\Container\Container;

class Route
{
    public static function route(string $httpMethod, string $uri, Dispatcher $dispatcher, Container $container): string
    {
        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        return self::routeInfo($routeInfo, $container);

    }

    private static function routeInfo(array $routeInfo, Container $container): string
    {
        if ($routeInfo[0] === Dispatcher::NOT_FOUND) {
            // ... 404 Not Found
            return $container->get(ErrorController::class)->fourOFour();
        }

        if ($routeInfo[0] === Dispatcher::METHOD_NOT_ALLOWED) {
            // ... 405 Method Not Allowed. Returns list of allowed methods for target function
            return $container->get(ErrorController::class)->fourOFive();
        }

        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$controller, $method] = $handler;
        return $container->get($controller)->$method($vars);
    }
}