<?php

// Procedural programming goes here :)
require_once "Race.php";                                // Application run
require_once "View.php";                                // Output strings
require_once "RaceRelated/Track.php";                   // Track configuration
require_once "RaceRelated/Participant.php";             // Includes objects through interface
require_once "RaceRelated/ParticipantCollection.php";   // Array has to be at least size of 2 for race to happen
require_once "Racers/Racer.php";                        // Interface
require_once "Racers/Mobile.php";                       // Abstract class for Mobile units
require_once "Racers/Car.php";
require_once "Racers/Human.php";
require_once "Racers/Airplane.php";

// $car1 = new Car("first test car", 50, 100, 50);
// $car2 = new Car("second test car", 60, 90, 40);
// var_dump($car1, $car2);

$participants = new ParticipantCollection();
$participants->addParticipants([
    new Participant(new Human("Boris the Fast", 1, 5, 60)),
    new Participant(new Car("BMW", 30, 100, 60)),
    new Participant(new Human("Cassandra", 2, 12, 75)),
    new Participant(new Airplane("SAAB", 80, 280, 45)),
    new Participant(new Car("Volvo", 25, 90, 25))
]);

var_dump($participants);