<?php

echo "CheckOddEven" . PHP_EOL;
$number = readline("Please enter number: ");
if (is_numeric($number) && gettype($number + 0) === "integer") {
    echo intval($number) & 1 ? "Odd Number\n" : "Even Number\n";
} else {
    echo "Not a number or integer!" . PHP_EOL;
}
exit("Bye!" . PHP_EOL);
// P.S. Ja nav nosacījuma programmā pēc "keypress", tad echo "Bye!" būs tas pats efekts, manuprāt.