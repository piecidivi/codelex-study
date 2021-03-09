<?php


class Shop extends Warehouse
{
    private int $money;

    public function __construct(string $name, int $initialMoney)
    {
        parent::__construct($name);
        $this->money = $initialMoney;
    }

    public function getBalance(): int {
        return $this->money;
    }

    public function addMoney(int $money): void {
        $this->money += $money;
    }

    public function deductMoney(int $money): void {
        $this->money -= $money;
    }

    // Mēs uz šito metodi padodam intvalu -> šī metode ir šeit vai aplikācijā? Kur mēs gribam atgiezt un pielikt puķes no noliktavas?
    public function obtainFlowers(): void {
        echo "Obtain Flowers from wholesaler\n------------------------------\n";
        echo "1. SillyTrade:\tGame -> \"Rock, Paper, Scissors\",\tMove price -> $500.00\n";
        echo "2. RegularTrade:\tGame -> \"Piglet to 10 points\",\tMove price -> $200.00\n";
        echo "3. HustleTrade:\tGame -> \"Guess number 1-10\",\tMove price -> $100.00\n";
        $wholesaler = intval(readline("Enter Your choice [1-3]: "));
        // Payment method has to be checked before entering method with switch statement, which will not allow dafault "undefined".

        switch ($wholesaler) {
            case 1:
                $game = new SillyTrade;
                break;
            case 2:
                $game = new RegularTrade;
                break;
            default:
                $game = new HustleTrade;
                break;
        }
        $this->executeTrade($game);
    }

    private function executeTrade(Trade $trade): void {
        $trade->pay($this);
    }
}