<?php

namespace App\Middlewares;

class MiddlewareBuilder
{
    private array $middleware = [];

    public function get(string $class): array
    {
        return $this->middleware[$class] ?? [];
    }

    public function add(string $class, string $method, array $conditions): void
    {
        $key = "{$class}@{$method}";
        foreach ($conditions as $condition) {
            $this->middleware[$key][] = $condition;
        }
    }
}