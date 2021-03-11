<?php


class Track
{
    private string $name;
    private int $length;

    public function __construct(string $name, int $length) {
        $this->name = $name;
        $this->length = $length;
    }
}