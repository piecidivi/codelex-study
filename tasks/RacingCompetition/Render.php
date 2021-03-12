<?php


class Render
{
    private const NAME_SPACING_CONST = 20;
    private const TRACK_FRONT = 20;
    private const TRACK_AFTER = 5;


    public static function participantTable(array $participants, string $trackName): string
    {
        $tableNumber = 1;
        $table = "Welcome to racing competition at $trackName autodrome!\n";
        $table .= "Following are participants taking part in competition:\n\n";
        $table .= "   ID\tPARTICIPANT         SPEED\tCRASH RATE\n";
        $table .= "---------------------------------------------------\n";

        foreach ($participants as $participant) {
            /** @var Participant $participant */
            $spacing = self::spacing($participant->getName(), self::NAME_SPACING_CONST);
            $table .= "{$tableNumber}. {$participant->getID()}\t{$participant->getName()}{$spacing}";
            $table .= "{$participant->getSpeed()}\t\t{$participant->getCrashRate()}%\n";
            $tableNumber++;
        }

        $table .= "\n";
        return $table;
    }

    public static function resultsTable(array $participants, array $finishers, array $crashers, int $trackOffsetStart): string
    {
        $tableNumber = 1;
        $table = "The results of competition:\n\n";
        $table .= "   ID\tPARTICIPANT         RESULT\n";
        $table .= "-------------------------------------\n";

        foreach ($finishers as $finisher) {
            foreach ($participants as $participant) {
                /** @var  Participant $participant */
                if ($finisher === $participant->getID()) {
                    $spacing = self::spacing($participant->getName(), self::NAME_SPACING_CONST);
                    $table .= "{$tableNumber}. {$participant->getID()}\t{$participant->getName()}{$spacing}{$participant->getRaceTime()}";
                    $table .= " ticks to reach finish\n";
                    $tableNumber++;
                }
            }
        }

        foreach ($crashers as $crasher) {
            foreach ($participants as $participant) {
                /** @var  Participant $participant */
                if ($crasher === $participant->getID()) {
                    $spacing = self::spacing($participant->getName(), self::NAME_SPACING_CONST);
                    $distance = $participant->gettrackPosition() - $trackOffsetStart;
                    $table .= "{$tableNumber}. {$participant->getID()}\t{$participant->getName()}{$spacing}{$distance}";
                    $table .= " distance travelled before crash\n";
                    $tableNumber++;
                }
            }
        }

        $table .= "\n";
        return $table;
    }

    private static function spacing(string $stringToEvaluate, int $length): string
    {
        if (strlen($stringToEvaluate) < $length) {
            $spacing = str_repeat(" ", self::NAME_SPACING_CONST - strlen($stringToEvaluate));
        } else {
            $spacing = "";
        }
        return $spacing;
    }

    public static function drawRace(array $participants, int $trackLength, int $trackOffsetStart): string
    {
        $trackFront = str_repeat(" ", self::TRACK_FRONT);
        $trackAfter = str_repeat(" ", self::TRACK_AFTER);
        $trackBorder = str_repeat("-", $trackLength);
        $trackInside = str_repeat(".", $trackLength);
        $inside = "{$trackFront}|{$trackInside}|{$trackAfter}\n";
        $drawTrack = "{$trackFront}|{$trackBorder}|{$trackAfter}\n";

        foreach ($participants as $participant) {
            /** @var Participant $participant */
            /** @var Track $track */
            $progress = self::raceProgress($participant->getID(), $participant->gettrackPosition(), $inside);
            if (!$participant->getMotionState()) {
                $progress = self::stopInfo($progress, $participant->getRaceTime(),
                    $participant->gettrackPosition() - $trackOffsetStart);
            }
            $drawTrack .= $progress;
        }

        $drawTrack .= "{$trackFront}|{$trackBorder}|{$trackAfter}\n";
        $drawTrack .= "\n";
        return $drawTrack;
    }

    private static function raceProgress(string $participantID, int $trackPosition, string $insideTrack): string
    {
        $idLength = strlen($participantID);
        return substr_replace($insideTrack, $participantID, $trackPosition - $idLength, $idLength);
    }

    private static function stopInfo(string $drawTrack, int $tick, int $trackPosition): string
    {
        if ($tick > 0) {
            $stopInfo = substr_replace($drawTrack, "Time " . $tick, 0, strlen("Time " . $tick));
        } else {
            $stopInfo = substr_replace($drawTrack, "Distance " . ($trackPosition), 0, strlen("Distance " . ($trackPosition)));
        }
        return $stopInfo;
    }
}