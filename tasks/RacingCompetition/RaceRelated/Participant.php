<?php


class Participant
{
    private string $id;
    private int $speed;
    private int $crashRate;
    private int $fieldPosition = 0;
    // private int $raceTime;

    public function __construct(string $id, int $speed, int $crashRate) {
        $this->id = $id;
        $this->speed = $speed;
        $this->crashRate = $crashRate;
    }

    public function getID(): string {
        return $this->id;
    }

    public function getSpeed(): int {
        return $this->speed;
    }

    public function getCrashRate(): int {
        return $this->crashRate;
    }

    public function getFieldPosition(): int {
        return $this->fieldPosition;
    }

    /*
    public function getRaceTime(): int {
        return $this->raceTime;
    }
    */

    public function setFieldPosition(): void {
        $this->fieldPosition += $this->speed;
    }

    /*
    public function setRaceTime(int $raceTime): void {
        $this->raceTime = $raceTime;
    }
    */
}