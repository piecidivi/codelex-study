<?php

namespace App;

class Game
{
    // If returns true, goal accomplished, and we have a deal.
    public static function rps(Shop $shop): bool
    {
        echo "\nWelcome to game of Rock, Paper, Scissors!\n";
        echo "You need to win to get flowers! One move costs 500.00. Good luck!\n";
        $validOptions = ["r", "p", "s"];

        do {
            $shop->deductMoney(50000);
            $winner = false;
            $userChoice = strtolower(readline("Choose from (rock - r, paper - p, or scissors - s): "));
            $computerChoice = $validOptions[array_rand($validOptions, 1)];  // returns value of array element
            echo "Computer chose: $computerChoice\n";

            if (in_array($userChoice, $validOptions)) {
                if ($userChoice === $computerChoice) {
                    echo "It is a tie!\n";
                    $balance = number_format($shop->getBalance() / 100, 2);
                    echo "Your balance is: $balance\n";
                    continue;
                }
                $winner = ($userChoice === $validOptions[self::rpsChooseWinner($userChoice, $computerChoice, $validOptions)]);
                echo $winner ?
                    "Player wins!\n" : "Computer wins!\n";
            } else {
                echo "Invalid option selected!\n";
            }
            $balance = number_format($shop->getBalance() / 100, 2);
            echo "Your balance is: $balance\n";
        } while (!$winner && (strtolower(readline("Play again? ('y' - yes, 'n' - no) ")[0]) === "y"));
        if (!$winner) {
            echo "Thanks for visiting us. Better luck next time!\n";
        } else {
            echo "You have won!\n";
        }
        readline("Press 'Enter' to continue...");
        return $winner;
    }


    private static function rpsChooseWinner(string $userChoice, string $computerChoice, array $validOptions): int
    {
        return abs(array_search($userChoice, $validOptions) - array_search($computerChoice, $validOptions)) === 1 ?
            max(array_search($userChoice, $validOptions), array_search($computerChoice, $validOptions)) :
            min(array_search($userChoice, $validOptions), array_search($computerChoice, $validOptions));
    }

    // If returns true, goal accomplished, and we have a deal.
    public static function piglet(Shop $shop): bool
    {
        $totalPoints = 0;
        echo "\nWelcome to Piglet!\n";
        echo "You need to make 10 points to get flowers.\n";
        echo "You currently have $totalPoints points. One move costs 200.00. Good luck!\n";

        do {
            $shop->deductMoney(20000);
            $turn = mt_rand(1, 6);
            if ($turn === 1) {
                $totalPoints = 0;
                echo "You rolled a $turn! You have $totalPoints points.\n";
            } else {
                $totalPoints += $turn;
                echo "You rolled a $turn! You have $totalPoints points.\n";
            }
            $balance = number_format($shop->getBalance() / 100, 2);
            echo "Your balance is $balance.\n";
        } while ($totalPoints < 10 && (strtolower(readline("Roll again? ('y' - yes, 'n' - no) ")[0]) === "y"));
        if ($totalPoints >= 10) {
            echo "You got $totalPoints points. You won!\n";
        } else {
            echo "Thanks for visiting us. Better luck next time!\n";
        }
        readline("Press 'Enter' to continue...");
        return $totalPoints >= 10;
    }

    // If returns true, goal accomplished, and we have a deal.
    public static function guessNumber(Shop $shop): bool
    {
        echo "\nWelcome to Guess Number game!\n";
        echo "You need to guess number in range 1-10 to get flowers.\n";
        echo "One guess costs 100.00. Good luck!\n";

        do {
            $shop->deductMoney(10000);
            $number = rand(1, 10);
            $guess = readline("Your guess: ");

            if (is_numeric($guess)) {
                if ($guess == $number) {
                    echo "You guessed it.";
                } else {
                    echo $guess > $number ? "Sorry, You are too high. I was thinking of $number.\n" :
                        "Sorry, You are too low. I was thinking of $number.\n";
                }
            } else {
                echo "Your guess is not a number.\n";
            }
            $balance = number_format($shop->getBalance() / 100, 2);
            echo "Your balance is $balance.\n";
        } while (($guess != $number) && (strtolower(readline("Roll again? ('y' - yes, 'n' - no) ")[0]) === "y"));
        if ($guess == $number) {
            echo "You won!\n";
        } else {
            echo "Thanks for visiting us. Better luck next time!\n";
        }
        readline("Press 'Enter' to continue...");
        return $guess == $number;
    }
}