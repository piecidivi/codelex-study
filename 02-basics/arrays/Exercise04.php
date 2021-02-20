<?php

$numbers1 = [];
for ($i = 0; $i < 10; ++$i) {
    array_push($numbers1, rand(1, 100));
}

$numbers2 = [...$numbers1];
$numbers1[count($numbers1) - 1] = -7;

echo "Array 1: ";
foreach ($numbers1 as $number) {
    echo "$number ";
}

echo "\nArray 2: ";
foreach ($numbers2 as $number) {
    echo "$number ";
}
echo PHP_EOL;

