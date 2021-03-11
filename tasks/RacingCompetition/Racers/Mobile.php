<?php


abstract class Mobile implements Racer
{
    protected static int $counter = 1;
    protected string $id;
    protected string $name;
    protected int $minSpeed;
    protected int $maxSpeed;
    protected int $crashRate;

    public function __construct(string $name,  int $minSpeed, int $maxSpeed, int $crashRate) {
        $this->id = "M" . self::$counter++;
        $this->name = $name;
        $this->minSpeed = $minSpeed;
        $this->maxSpeed = $maxSpeed;
        $this->crashRate = $crashRate;
    }
}