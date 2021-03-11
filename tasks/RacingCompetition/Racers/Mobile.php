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
        $this->setSpeedLimits($minSpeed, $maxSpeed);
        $this->setCrashRate($crashRate);

    }

    // Protection for ambiguous values etc.
    protected function setCrashRate(int $crashRate): void {
        switch(true) {
            case $crashRate < 0:
                $this->crashRate = 0;
                break;
            case $crashRate > 100:
                $this->crashRate = 100;
                break;
            default:
                $this->crashRate = $crashRate;
        }
    }

    // Protection for ambiguous values etc.
    protected function setSpeedLimits(int $minSpeed, int $maxSpeed): void {
        if ($minSpeed < 1) $this->minSpeed = 1;
        else $this->minSpeed = $minSpeed;

        if ($maxSpeed < $this->minSpeed) $this->maxSpeed = $this->minSpeed;
        else $this->maxSpeed = $maxSpeed;
    }
}