<?php


class ParticipantCollection
{
    private array $participants = [];

    public function getParticipants(): array {
        return $this->participants;
    }

    public function addParticipants(array $participants): void {
        foreach ($participants as $participant) {
            $this->addOneParticipant($participant);
        }
    }

    public function addOneParticipant(Participant $participant): void {
        $this->participants[] = $participant;
    }
}