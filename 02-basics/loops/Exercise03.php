<?php

$firstWord = readline("Enter first word: ");
$secondWord = readline("Enter second word: ");
$dotsCount = 30 - (strlen($firstWord) + strlen($secondWord));

echo $firstWord;
if ($dotsCount > 0) {
    do {
        echo ".";
        $dotsCount--;
    } while ($dotsCount > 0);
}
echo $secondWord . PHP_EOL;