<?php


do {
    $userString = readline("Please enter string (3 or more letters): ");
} while(strlen($userString) < 3);

for ($i = 0; $i < strlen($userString); $i += 3) {
    $substringArray[] = substr($userString, $i, 3);
}

var_dump($substringArray);