<?php

namespace App\Views;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class View
{
    public static function output(string $template, array $parameters): string
    {
        $loader = new FilesystemLoader("../app/Views/Templates");
        $twig = new Environment($loader, [
            "strict_variables" => true  // Throw exception if variable is null
        ]);
        try {
            return $twig->render($template, $parameters);
        } catch (LoaderError | RuntimeError | SyntaxError $exception) {
            return "Line {$exception->getTemplateLine()}. {$exception->getMessage()}";
        }
    }
}