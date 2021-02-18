<?php

$animals = ["sheep", "sheep", "sheep", "wolf", "sheep", "wolf", "sheep", "sheep" ];
$emotions = "";

for ($i = 0; $i < count($animals); ++$i) {

    if ($animals[$i] === "wolf") {
        $emotions .= "HEHE, ";
        continue;
    }

    if ((isset($animals[$i - 1]) && $animals[$i - 1] === "wolf") ||
        (isset($animals[$i + 1]) && $animals[$i + 1] === "wolf")) {
        $emotions .= "OMG, ";
    } else {
        $emotions .= "Happy, ";
    }
}

echo substr($emotions, 0, -2) . "." . PHP_EOL;