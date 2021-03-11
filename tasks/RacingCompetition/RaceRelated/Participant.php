<?php


class Participant
{
    private Racer $racer;
    private string $participantNumber;
    private static int $counter = 1;

    public function __construct(Racer $racer) {
        $this->racer = $racer;
        $this->participantNumber = self::$counter++;
    }

    public function getRacer(): Racer {
        return $this->racer;
    }

    public function getParticipantNumber(): string {
        return $this->participantNumber;
    }

}