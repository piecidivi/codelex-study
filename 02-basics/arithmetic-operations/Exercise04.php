<?php

$output = $upperNumber = 10;
$factorial = 1;
if ($output !== 0) {
    while ($upperNumber > 0) {
        $factorial *= $upperNumber;
        $upperNumber--;
    }
    echo "Factorial of $output is $factorial." . PHP_EOL;
} else {
    echo "Factorial of $output is 1." . PHP_EOL;
}


