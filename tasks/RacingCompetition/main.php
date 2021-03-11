<?php

// Procedural programming goes here :)
require_once "RaceRelated/Participant.php";
require_once "RaceRelated/ParticipantCollection.php";
require_once "RaceRelated/Track.php";                   // Track configuration
require_once "Racers/RacerCollection.php";   // Array has to be at least size of 2 for race to happen
require_once "Racers/Racer.php";                        // Interface
require_once "Racers/Mobile.php";                       // Abstract class for Mobile units
require_once "Racers/Car.php";
require_once "Racers/Human.php";
require_once "Racers/Airplane.php";
require_once "Render.php";                                // Output strings
require_once "Competition.php";


// Create track
$track = new Track("Silverstone", 150);


// Create objects
$racers = new RacerCollection();
$racers->addRacers([
    new Human("Boris the Fast", 1, 5, 60),
    new Car("BMW", 30, 100, 60),
    new Human("Cassandra", 2, 12, 75),
    new Airplane("SAAB", 80, 280, 45),
    new Car("Volvo", 25, 90, 25)
]);
var_dump($racers);

// Create participants
$participants = new ParticipantCollection();
foreach ($racers->getRacers() as $racer) {
    /** @var Racer $racer */
    $participants->addOneParticipant(new Participant($racer->getID(), $racer->getSpeed(), $racer->getCrashRate()));
}
var_dump($participants);


// Run race
$race = new Competition();
// returns associative array id => time (-1 - DNF)
$result = $race->race($participants->getParticipants(), $track->getLength());


