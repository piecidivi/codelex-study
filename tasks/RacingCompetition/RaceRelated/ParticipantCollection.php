<?php


class ParticipantCollection
{
    private array $participants = [];

    public function getParticipants(): array
    {
        return $this->participants;
    }

    public function getActive(): array
    {
        return array_filter($this->participants,
            fn(Participant $participant) => $participant->getMotionState());
    }

    public function addOneParticipant(Participant $participant): void
    {
        $this->participants[] = $participant;
    }
}