<?php


class Competition
{
    private ParticipantCollection $participants;
    private Track $track;
    private int $time = 0;
    private array $finishers = [];
    private array $crashers = [];


    public function __construct(ParticipantCollection $participants, Track $track)
    {
        $this->participants = $participants;
        $this->track = $track;
    }

    public function competition(): ParticipantCollection
    {
        $this->time++;
        foreach ($this->participants->getActive() as $participant) {
            /** @var Participant $participant */
            $participant->setTrackPosition();
            if ($participant->getTrackPosition() >= $this->track->getLength() + $this->track->getTrackOffsetFinish()) {
                // This is to avoid "speed" exceeding track.
                $participant->adjustTrackPosition($this->track->getLength() + $this->track->getTrackOffsetFinish());
                $participant->setMotionState(false);
                $participant->setRaceTime($this->time);
                $this->finishers[] = $participant->getID();
                continue;
            }
            if (mt_rand(1, 100) <= $participant->getCrashRate()) {
                $participant->setMotionState(false);
                $participant->setRaceTime(0);
                $this->crashers[$participant->getTrackPosition()] = $participant->getID();
                continue;
            }
        }
        return $this->participants;
    }

    public function getFinishers(): array
    {
        return $this->finishers;
    }

    public function getCrashers(): array
    {
        krsort($this->crashers, 1);
        return $this->crashers;
    }
}