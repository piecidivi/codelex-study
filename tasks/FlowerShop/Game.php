<?php


class Game
{
    // If returns true, goal accomplished, and we have a deal.
    public static function rps(Shop $shop): bool {
        echo "Welcome to game of Rock, Paper, Scissors!\n";
        echo "You need to win to get flowers! One move costs $500.00. Good luck!\n";
        $validOptions = ["r", "p", "s"];

        do {
            $shop->deductMoney(50000);
            $winner = false;
            $userChoice = strtolower(readline("Choose from (rock - r, paper - p, or scissors - s): "));
            $computerChoice = $validOptions[array_rand($validOptions, 1)];  // returns value of array element
            echo "Computer chose: $computerChoice" . PHP_EOL;

            if (in_array($userChoice, $validOptions)) {
                if ($userChoice === $computerChoice) {
                    echo "It is a tie!" . PHP_EOL;
                    break;
                }
                $winner = ($userChoice === $validOptions[self::rpsChooseWinner($userChoice, $computerChoice, $validOptions)]);
                echo $winner ?
                    "Player wins!" . PHP_EOL : "Computer wins!" . PHP_EOL;
            } else {
                echo "Invalid option selected!" . PHP_EOL;
            }
        } while ((strtolower(readline("Play again? ('y' - yes, 'n' - no) ")[0]) === "y") && !$winner);

        return $winner;
    }


    private static function rpsChooseWinner(string $userChoice, string $computerChoice, array $validOptions): int
    {
        return abs(array_search($userChoice, $validOptions) - array_search($computerChoice, $validOptions)) === 1 ?
            max(array_search($userChoice, $validOptions), array_search($computerChoice, $validOptions)) :
            min(array_search($userChoice, $validOptions), array_search($computerChoice, $validOptions));
    }

    // If returns true, goal accomplished, and we have a deal.
    public static function piglet(Shop $shop): bool {
        $totalPoints = 0;
        echo "Welcome to Piglet!\n";
        echo "You need to make 10 points to get flowers.\n";
        echo "You currently have $totalPoints points.One move costs $200.00. Good luck!\n";

        do {
            $shop->deductMoney(20000);
            $turn = mt_rand(1, 6);
            if ($turn === 1) {
                $totalPoints = 0;
                echo "You rolled a $turn! You have $totalPoints points.\n";
            }
            $totalPoints += $turn;
            echo "You rolled a $turn! You have $totalPoints points.\n";
            echo "Your balance is {$shop->getBalance()}.\n";
        } while ((strtolower(readline("Roll again? ('y' - yes, 'n' - no) ")[0]) === "y") && $totalPoints < 10);
        echo "You got $totalPoints points." . PHP_EOL;
        return $totalPoints >= 10;
    }

    public static function guessNumber(Shop $shop): bool {
        echo "Welcome to Guess Number!\n";
        echo "You need to guess number in range 1-10 to get flowers.\n";
        echo "One guess costs $100.00. Good luck!\n";

        do {
            $shop->deductMoney(10000);
            $number = rand(1, 10);
            $guess = readline("Your guess: ");

            if (is_numeric($guess)) {
                if ($guess == $number) {
                    echo "You guessed it!!!\n";
                } else {
                    echo $guess > $number ? "Sorry, You are too high. I was thinking of $number." . PHP_EOL :
                        "Sorry, You are too low. I was thinking of $number." . PHP_EOL;
                }
            } else {
                echo "Your guess is not a number." . PHP_EOL;
            }
        } while ((strtolower(readline("Roll again? ('y' - yes, 'n' - no) ")[0]) === "y") && $guess !== $number);
        return $guess === $number;
    }
}