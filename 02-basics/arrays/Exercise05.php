<?php

class Board
{
    private array $board = [
        [" ", " ", " "],
        [" ", " ", " "],
        [" ", " ", " "]
    ];
    private string $moveValue = "X";
    private string $winner = "-";

    public function getBoard(int $value1, int $value2): string
    {
        return $this->board[$value1][$value2];
    }

    public function getMoveValue(): string
    {
        return $this->moveValue;
    }

    public function getWinner(): string
    {
        return $this->winner;
    }

    public function countEmptyCells(): int
    {
        return count(array_keys($this->board[0], " ")) +
            count(array_keys($this->board[1], " ")) +
            count(array_keys($this->board[2], " "));
    }

    public function updateBoard(int $input1, int $input2): void
    {
        $this->board[$input1][$input2] = $this->moveValue;
        $this->calculateNextMoveValue();
        $this->calculateWinner();
    }

    private function calculateNextMoveValue(): void
    {
        $this->moveValue === "X" ? $this->moveValue = "O" : $this->moveValue = "X";
    }

    private function calculateWinner(): void
    {
        // Horizontal
        for ($i = 0; $i < count($this->board); ++$i) {
            if (($this->board[$i][0] === $this->board[$i][1]) && ($this->board[$i][1] === $this->board[$i][2]) && $this->board[$i][0] !== " ") {
                $this->winner = $this->board[$i][0];
            }
        }

        // Vertical
        for ($i = 0; $i < count($this->board); ++$i) {
            if (($this->board[0][$i] === $this->board[1][$i]) && ($this->board[1][$i] === $this->board[2][$i]) && $this->board[0][$i] !== " ") {
                $this->winner = $this->board[0][$i];
            }
        }

        // Diagonal 1
        if (($this->board[0][0] === $this->board[1][1]) && ($this->board[1][1] === $this->board[2][2]) && $this->board[0][0] !== " ") {
            $this->winner = $this->board[0][0];
        }

        // Diagonal 2
        if (($this->board[0][2] === $this->board[1][1]) && ($this->board[1][1] === $this->board[2][0]) && $this->board[0][2] !== " ") {
            $this->winner = $this->board[0][2];
        }
    }
}


class Game
{
    private Board $board;


    function __construct()
    {
        $this->board = new Board();
    }

    public function playGame(): void
    {
        do {
            $this->drawBoard();
            $this->makeMove();
        } while ($this->board->getWinner() === "-" && $this->board->countEmptyCells() > 0);

        // Finalize
        $this->drawBoard();
        echo $this->board->getWinner() !== "-" ?
            PHP_EOL . "The winner is {$this->board->getWinner()}!" . PHP_EOL :
            PHP_EOL . "The game is a tie." . PHP_EOL;
    }

    private function drawBoard(): void
    {
        echo PHP_EOL;
        echo " {$this->board->getBoard(0, 0)} | {$this->board->getBoard(0, 1)} | {$this->board->getBoard(0, 2)} \n";
        echo "---+---+---\n";
        echo " {$this->board->getBoard(1, 0)} | {$this->board->getBoard(1, 1)} | {$this->board->getBoard(1, 2)} \n";
        echo "---+---+---\n";
        echo " {$this->board->getBoard(2, 0)} | {$this->board->getBoard(2, 1)} | {$this->board->getBoard(2, 2)} \n";
    }

    private function makeMove(): void
    {
        echo PHP_EOL . "'{$this->board->getMoveValue()}' choose your location (row, column): ";
        fscanf(STDIN, "%d %d", $input1, $input2);

        // This is needed for accidental "Enter" without value -> some fake integer assigned
        // Otherwise will throw error on validateInput receiving null instead of integer
        if (!(isset($input1)) || !(isset($input2))) {
            $input1 = 5;
            $input2 = 5;
        }

        while ($this->validateInput($input1, $input2)) {
            echo "This location is occupied or wrong values entered. Please choose different: ";
            fscanf(STDIN, "%d %d", $input1, $input2);

            // This is needed for accidental "Enter" without value -> some fake integer assigned
            // Otherwise will throw error on validateInput receiving null instead of integer
            if (!(isset($input1)) || !(isset($input2))) {
                $input1 = 5;
                $input2 = 5;
            }
        }
        $this->board->updateBoard($input1, $input2);
    }

    // Returns true, when everything is bad, for validateMove to run... while "everything is bad" === true
    // Returns false, when validation succeeds
    private function validateInput(int $input1, int $input2): bool
    {
        if ($input1 < 0 || $input1 > 2 || $input2 < 0 || $input2 > 2) {
            return true;
        }
        if ($this->board->getBoard($input1, $input2) !== " ") {
            return true;
        }
        return false;
    }
}

$game = new Game();
$game->playGame();