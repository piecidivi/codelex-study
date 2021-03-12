<?php


require_once "RaceRelated/Participant.php";
require_once "RaceRelated/ParticipantCollection.php";
require_once "RaceRelated/Track.php";
require_once "Racers/RacerCollection.php";
require_once "Racers/Racer.php";
require_once "Racers/Mobile.php";
require_once "Racers/Car.php";
require_once "Racers/Human.php";
require_once "Racers/Airplane.php";
require_once "Render.php";
require_once "Competition.php";


// Create objects
$racers = new RacerCollection();
$racers->addRacers([
    new Human("Boris the Fast", 1, 3, 5),
    new Car("BMW", 4, 7, 0),
    new Human("Cassandra", 1, 3, 6),
    new Airplane("SAAB", 8, 12, 0),
    new Car("Volvo", 4, 6, 9)
]);

// Create track
$track = new Track("Silverstone", 150);

// Create participants
$participants = new ParticipantCollection();
foreach ($racers->getRacers() as $racer) {
    /** @var Racer $racer */
    $participants->addOneParticipant(new Participant(
            $racer->getID(),
            $racer->getName(), $racer->getSpeed(),
            $racer->getCrashRate(), $track->getTrackOffset()
        )
    );
}

// View participants table
echo Render::participantTable($participants->getParticipants(), $track->getName());

// Race
$competition = new Competition($participants, $track);
readline("Please press 'Enter' to start race...");
system("clear");
echo PHP_EOL . Render::drawRace($participants->getParticipants(), $track->getLength(), $track->getTrackOffsetStart());
echo "Ready -> ";
sleep(1);
echo "set -> ";
sleep(1);
echo "GO!\n";

do {

    $participants = $competition->competition();
    usleep(500000);
    system("clear");
    echo PHP_EOL . Render::drawRace($participants->getParticipants(),
            $track->getLength(), $track->getTrackOffsetStart());

} while (count($participants->getActive()) > 0);

echo "Competition is over!\n";
readline("Please press 'Enter' to proceed.");

// Results table
echo Render::resultsTable($participants->getParticipants(), $competition->getFinishers(),
    $competition->getCrashers(), $track->getTrackOffsetStart());