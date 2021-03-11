<?php


class Render
{
    public static function drawTrack(int $length): string {
        return str_repeat(".", $length) . PHP_EOL;
    }

    public static function resultsTable(): string {
        return "1";
    }
}