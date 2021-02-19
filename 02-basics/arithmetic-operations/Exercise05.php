<?php

$number = rand(1, 100);
echo "I'm thinking of number between 1-100. Try to guess it." . PHP_EOL;
$guess = readline("> ");

if (is_numeric($guess)) {

    if ($guess == $number) {
        echo "You guessed it! What are the odds?!?" . PHP_EOL;
    } else {
        echo $guess > $number ? "Sorry, You are too high. I was thinking of $number." . PHP_EOL :
            "Sorry, You are too low. I was thinking of $number." . PHP_EOL;
    }

} else {
    echo "Your guess is not a number." . PHP_EOL;
}

