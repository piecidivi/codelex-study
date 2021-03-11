<?php


class RacerCollection
{
    private array $racers = [];


    public function getRacers(): array {
        return $this->racers;
    }


    public function addRacers(array $racers): void {
        foreach ($racers as $racer) {
            $this->add($racer);
        }
    }

    private function add(Racer $racer) {
        $this->racers[] = $racer;
    }

}