<?php

function displayBoard(array $board): array
{
    echo PHP_EOL;
    echo " {$board[0][0]} | {$board[0][1]} | {$board[0][2]} \n";
    echo "---+---+---\n";
    echo " {$board[1][0]} | {$board[1][1]} | {$board[1][2]} \n";
    echo "---+---+---\n";
    echo " {$board[2][0]} | {$board[2][1]} | {$board[2][2]} \n";
    $nextMove = nextToMove($board) ? "X" : "O";
    echo PHP_EOL . "'$nextMove' choose your location (row, column): ";
    $board = validateMove($nextMove, $board);
    return $board;
}

function nextToMove(array $board): bool
{
    $freeCount = 0;
    for ($i = 0; $i < count($board); ++$i) {
        if (in_array(" ", $board[$i])) {
            $freeCount += array_count_values($board[$i])[" "];
        }
    }
    return $freeCount & 1;
}

function validateMove(string $nextMove, array $board): array
{
    fscanf(STDIN, "%d %d", $value1, $value2);
    if (validateInput(intval($value1), intval($value2), $board)) {
        do {
            echo "This location is occupied or wrong values entered. Please choose different: ";
            fscanf(STDIN, "%d %d", $value1, $value2);
        } while (validateInput(intval($value1), intval($value2), $board));
    }
    $board[$value1][$value2] = $nextMove;
    return $board;
}

// Returns true, when everything is bad, for validateMove to run... while "everything is bad" === true
// Returns false, when validation succeeds
function validateInput(int $value1, int $value2, array $board): bool
{
    if ($value1 < 0 || $value1 > 2 || $value2 < 0 || $value2 > 2) {
        return true;
    }
    if ($board[$value1][$value2] !== " ") {
        return true;
    }
    return false;
}


function calculateWinner(array $board): string
{
    // Horizontal
    for ($i = 0; $i < count($board); ++$i) {
        if (($board[$i][0] === $board[$i][1]) && ($board[$i][1] === $board[$i][2]) && $board[$i][0] !== " ") {
            return $board[$i][0];
        }
    }

    // Vertical
    for ($i = 0; $i < count($board); ++$i) {
        if (($board[0][$i] === $board[1][$i]) && ($board[1][$i] === $board[2][$i]) && $board[0][$i] !== " ") {
            return $board[0][$i];
        }
    }

    // Diagonal 1
    if (($board[0][0] === $board[1][1]) && ($board[1][1] === $board[2][2]) && $board[0][0] !== " ") {
        return $board[0][0];
    }

    // Diagonal 2
    if (($board[0][2] === $board[1][1]) && ($board[1][1] === $board[2][0]) && $board[0][2] !== " ") {
        return $board[0][2];
    }

    return "-";
}

// Gameplay
$board = [
    [" ", " ", " "],
    [" ", " ", " "],
    [" ", " ", " "]
];
$winner = "-";
$movesLeft = 9;

do {
    $board = displayBoard($board);
    $winner = calculateWinner($board);
    $movesLeft--;
} while ($winner === "-" && $movesLeft > 0);

// Draw final view
echo PHP_EOL;
echo " {$board[0][0]} | {$board[0][1]} | {$board[0][2]} \n";
echo "---+---+---\n";
echo " {$board[1][0]} | {$board[1][1]} | {$board[1][2]} \n";
echo "---+---+---\n";
echo " {$board[2][0]} | {$board[2][1]} | {$board[2][2]} \n";
echo PHP_EOL;

// Announce outcome
echo $winner !== "-" ? "The winner is $winner!" . PHP_EOL : "The game is a tie." . PHP_EOL;