<?php


class Word
{
    private array $listOfWords = [
        "variable", "condition", "array",
        "loop", "class", "function",
        "operation", "interface", "operand"];
    private array $wordToGuess;
    private array $guessProgress;
    private array $misses;


    function __construct()
    {
        // $this->wordToGuess = str_split($this->listOfWords[rand(0, count($this->listOfWords) - 1)]);
        $this->wordToGuess = str_split($this->listOfWords[array_rand($this->listOfWords, 1)]);
        $this->guessProgress = array_fill(0, count($this->wordToGuess), "_");
        $this->misses = [];

    }

    public function guessProgress(): array
    {
        return $this->guessProgress;
    }

    public function correctGuess(): bool
    {
        return $this->guessProgress === $this->wordToGuess;
    }

    public function misses(): array
    {
        return $this->misses;
    }

    // If match, replace in progress, else place in missed.
    public function storeGuessedValue(string $guessedValue): void
    {
        if (in_array($guessedValue, $this->wordToGuess)) {
            foreach ($this->wordToGuess as $key => $value) {
                if ($this->wordToGuess[$key] === $guessedValue) {
                    $this->guessProgress[$key] = $guessedValue;
                }
            }
        } else {
            if (!(in_array($guessedValue, $this->misses))) {
                array_push($this->misses, $guessedValue);
            }
        }
    }

    // Check if full word match
    public function checkFullMatch(string $guessedValue): void
    {
        if ($this->wordToGuess === str_split($guessedValue)) {
            $this->guessProgress = str_split($guessedValue);
        }
    }

}


class Game
{
    private Word $word;
    private int $triesCount;


    function __construct()
    {
        $this->word = new Word();
        $this->triesCount = 10;
    }

    public function playGame()
    {
        do {
            $this->drawBoard();
            $this->makeGuess();
            $this->triesCount--;
        } while (!$this->word->correctGuess() && $this->triesCount > 0);

        // Finalize
        $this->drawBoard();
        echo $this->word->correctGuess() ?
            "It is a win!" . PHP_EOL :
            "Out of moves. Better luck next time!" . PHP_EOL;
    }

    private function drawBoard(): void
    {
        echo PHP_EOL;
        echo "-=-=-=-=-=-=-=-=-=-=-=-=-=-" . PHP_EOL;
        echo "Tries left: $this->triesCount" . PHP_EOL . PHP_EOL;
        echo "Word:	" . implode(" ", $this->word->guessProgress()) . PHP_EOL . PHP_EOL;
        echo "Misses: " . implode(" ", $this->word->misses()) . PHP_EOL . PHP_EOL;
    }

    private function makeGuess(): void
    {
        $input = $this->validateInput();
        strlen($input) === 1 ?
            $this->word->storeGuessedValue($input) :
            $this->word->checkFullMatch($input);
    }

    private function validateInput(): string
    {
        return strtolower(readline("Guess letter or entire word: "));
    }
}

$game = new Game();
$game->playGame();