<?php

namespace Bootstrap;

use App\Controllers\ErrorController;
use FastRoute\Dispatcher;
use League\Container\Container;

class Route
{
    public static function route(string $httpMethod, string $uri, Dispatcher $dispatcher, Container $container): void
    {
        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        self::routeInfo($routeInfo, $container);

    }

    private static function routeInfo(array $routeInfo, Container $container): void
    {
        if ($routeInfo[0] === Dispatcher::NOT_FOUND) {
            // ... 404 Not Found
            $container->get(ErrorController::class)->fourOFour();
            return;
        }

        if ($routeInfo[0] === Dispatcher::METHOD_NOT_ALLOWED) {
            // ... 405 Method Not Allowed. Returns list of allowed methods for target function
            $allowedMethods = $routeInfo[1];
            $container->get(ErrorController::class)->fourOFive($allowedMethods);
            return;
        }

        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$controller, $method] = $handler;
        $container->get($controller)->$method($vars);
    }
}