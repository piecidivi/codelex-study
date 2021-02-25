<?php

class AsciiFigure
{
    private string $star = "*";
    private string $slash = "/";
    private string $backSlash = "\\";
    private const FIGURE_SIZE = 5;

    public function figure(): string
    {
        $figureOutput = "";
        for ($i = 0; $i < self::FIGURE_SIZE; ++$i) {
            $half = ((self::FIGURE_SIZE - 1 - $i) * 8) / 2;
            $stars = $i * 8;
            $figureOutput .= str_repeat($this->slash, $half)
                . str_repeat($this->star, $stars)
                . str_repeat($this->backSlash, $half)
                . PHP_EOL;
        }
        return $figureOutput;
    }
}

$figure = new AsciiFigure();
echo $figure->figure();