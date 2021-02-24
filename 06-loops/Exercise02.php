<?php

$n = intval(readline("Input number of terms: "));
$m = 1;
for ($i = 1; $i < $n + 1; ++$i) {
    $m *= $i;
}
echo "Multiplication result is: $m" . PHP_EOL;

//todo complete loop to multiply i with itself n times, it is NOT allowed to use built-in pow() function