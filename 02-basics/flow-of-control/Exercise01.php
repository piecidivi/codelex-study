<?php

$num1 = intval(readline("Input the 1st number: "));
$num2 = intval(readline("Input the 2nd number: "));
$num3 = intval(readline("Input the 3rd number: "));

echo "The largest number is: " . ($num1 >= $num2 ? ($num1 >= $num3 ? $num1 : $num3) :
        ($num2 >= $num3 ? $num2 : $num3)) . PHP_EOL;

