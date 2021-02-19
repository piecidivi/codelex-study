<?php

class Geometry
{

    public static function circleArea(float $radius): float
    {
        return pi() * $radius ** 2;
    }

    public static function rectangleArea(float $length, float $width): float
    {
        return $length * $width;
    }

    public static function triangleArea(float $base, float $height): float
    {
        return $base * $height * 0.5;
    }
}

function menu(): string
{
    echo "Geometry Calculator" . PHP_EOL;
    echo "1. Calculate the Area of a Circle" . PHP_EOL;
    echo "2. Calculate the Area of a Rectangle" . PHP_EOL;
    echo "3. Calculate the Area of a Triangle" . PHP_EOL;
    echo "4. Quit" . PHP_EOL;
    return readline("Enter your choice (1-4) : ");
}

function validateInput(string $input): bool
{
    return is_numeric($input) && $input >= 0;
}

do {
    $menu = menu();
    if (strlen($menu) === 1) {
        $menu = ord($menu);
        switch ($menu) {
            case 49:
                $radius = readline("Please enter radius of circle: ");
                echo validateInput($radius) ?
                    sprintf("-> Area of circle is %.2f", Geometry::circleArea($radius)) . PHP_EOL . PHP_EOL :
                    "-> Provided non-numerical or negative value." . PHP_EOL . PHP_EOL;
                break;
            case 50:
                $length = readline("Please enter length of rectangle: ");
                $width = readline("Please enter width of rectangle: ");
                echo validateInput($length) && validateInput($width) ?
                    sprintf("-> Area of rectangle is %.2f", Geometry::rectangleArea($length, $width)) . PHP_EOL . PHP_EOL :
                    "-> Provided non-numerical or negative value." . PHP_EOL . PHP_EOL;
                break;
            case 51:
                $base = readline("Please enter base length of triangle: ");
                $height = readline("Please enter height of triangle: ");
                echo validateInput($base) && validateInput($height) ?
                    sprintf("-> Area of rectangle is %.2f", Geometry::triangleArea($base, $height)) . PHP_EOL . PHP_EOL :
                    "-> Provided non-numerical or negative value." . PHP_EOL . PHP_EOL;
                break;
            case 52:
                echo "PHP rulezzz! :)" . PHP_EOL;
                break;
            default:
                echo "Wrong selection." . PHP_EOL . PHP_EOL;
        }
    } else {
        $menu = 1;
        echo "Wrong selection." . PHP_EOL . PHP_EOL;
    }
} while ($menu !== 52);
