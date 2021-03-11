<?php


class ParticipantCollection
{
    private array $participants = [];   // Associative array with participant number as key, and Racer object as value

    public function getParticipants(): array {
        return $this->participants;
    }

    public function addParticipants(array $participants): void {
        foreach ($participants as $participant) {
            $this->add($participant);
        }
    }

    private function add(Participant $participant) {
        $this->participants[$participant->getParticipantNumber()] = $participant->getRacer();
    }

}