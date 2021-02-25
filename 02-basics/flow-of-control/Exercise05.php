<?php

function phoneKeyPad(string $userString): string
{
    $numberString = "";
    for ($i = 0; $i < strlen($userString); ++$i) {
        switch (true) {
            case strpos("ABC", $userString[$i]) !== false:
                $numberString .= "2";
                break;
            case strpos("DEF", $userString[$i]) !== false:
                $numberString .= "3";
                break;
            case strpos("GHI", $userString[$i]) !== false:
                $numberString .= "4";
                break;
            case strpos("JKL", $userString[$i]) !== false:
                $numberString .= "5";
                break;
            case strpos("MNO", $userString[$i]) !== false:
                $numberString .= "6";
                break;
            case strpos("PQRS", $userString[$i]) !== false:
                $numberString .= "7";
                break;
            case strpos("TUV", $userString[$i]) !== false:
                $numberString .= "8";
                break;
            case strpos("WXYZ", $userString[$i]) !== false:
                $numberString .= "9";
                break;
        }
    }
    return $numberString;
}

do {
    $userString = strtoupper(readline("Please enter string (1 or more letters): "));
} while (strlen($userString) < 1);

echo phoneKeyPad($userString) . PHP_EOL;
