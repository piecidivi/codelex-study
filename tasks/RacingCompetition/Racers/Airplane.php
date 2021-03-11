<?php


class Airplane extends Mobile
{
    public function getID(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSpeed(): int
    {
        return mt_rand($this->minSpeed, $this->maxSpeed);
    }

    public function getCrashRate(): int
    {
        return $this->crashRate;
    }
}