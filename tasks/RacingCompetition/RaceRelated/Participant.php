<?php


class Participant
{
    private string $id;
    private string $name;
    private int $speed;
    private int $crashRate;
    private int $trackPosition;
    private bool $motionState = true;
    private int $raceTime = 0;

    public function __construct(string $id, string $name, int $speed, int $crashRate, int $trackOffset)
    {
        $this->id = $id;
        $this->name = $name;
        $this->speed = $speed;
        $this->crashRate = $crashRate;
        $this->trackPosition = $trackOffset;    // Participant starts right before start line, which is 21st char in string.
    }

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
        return $this->speed;
    }

    public function getCrashRate(): int
    {
        return $this->crashRate;
    }

    public function getTrackPosition(): int
    {
        return $this->trackPosition;
    }

    public function getMotionState(): bool
    {
        return $this->motionState;
    }

    public function getRaceTime(): int
    {
        return $this->raceTime;
    }

    public function setTrackPosition(): void
    {
        $this->trackPosition += $this->speed;
    }

    public function adjustTrackPosition(int $trackPosition): void
    {
        $this->trackPosition = $trackPosition;
    }

    public function setMotionState(bool $state): void
    {
        $this->motionState = $state;
    }

    // On crash raceTime is "0". In race (unless crashed) minimum race time will be 1.
    public function setRaceTime(int $raceTime): void
    {
        $this->raceTime = $raceTime;
    }
}