<?php


class Competition
{
    // Mums visu laiku uz zīmēšanu ir jādod ārā dati
    public function race(array $participants, int $trackLength): array {
        $time = 0;
        $result = [];
        do {
            $time++;
            foreach ($participants as $key => $participant) {
                /** @var Participant $participant */
                // 1. Sarēķina crashRate -> ja slikti pušo output masīvā "id" => "-1"
                // 2. Sarēķina nākamo pozīciju. Pārbauda - ja galā, tad pušo output masīvā "id" => "time"
                if (mt_rand(1,100) <= $participant->getCrashRate()) {
                    $result[$participant->getID()] = -1;
                    // Kaut kā jāatstāj standstilā uz spēles laukuma. Ko tad darīt ar while?
                    unset($participants[$key]);
                } else {
                    // Continue race
                    echo "Do something nice\n";
                }
            }

        } while (count($participants) > 0);
        return $result;
    }


}