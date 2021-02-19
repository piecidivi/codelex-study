<?php

for ($i = 0; $i <= 100; $i += 11) {
    for ($j = 1; $j <= 11; ++$j) {
        switch (true) {
            case ($i + $j) % 3 === 0 && ($i + $j) % 5 === 0:
                echo "CozaLoza ";
                break;
            case ($i + $j) % 3 === 0 && ($i + $j) % 7 === 0:
                echo "CozaWoza ";
                break;
            case ($i + $j) % 5 === 0 && ($i + $j) % 7 === 0:
                echo "LozaWoza ";
                break;
            case ($i + $j) % 3 === 0:
                echo "Coza ";
                break;
            case ($i + $j) % 5 === 0:
                echo "Loza ";
                break;
            case ($i + $j) % 7 === 0:
                echo "Woza ";
                break;
            default:
                echo $i + $j . " ";
        }
    }
    echo PHP_EOL;
}