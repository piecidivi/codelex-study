<?php

namespace App\Repositories\Balance;

use App\Models\Bankroll;
use App\Repositories\MySQLAbstract;
use Exception;

class MySQLBankrollRepository extends MySQLAbstract implements BankrollRepository
{
    public function add(Bankroll $bankroll): void
    {
        // TODO: Implement add() method.
    }

    /**
     * @throws Exception
     */
    public function getById(int $bankrollId): Bankroll
    {

        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new Exception("No connection to database.");
        }
        $data = $this->database->select("Bankroll", "*", [
            "id" => $bankrollId,
            "LIMIT" => 1
        ]);

        if (count($data) !== 1) {
            throw new Exception("Share not found!");
        }
        return new Bankroll($data[0]["id"], $data[0]["name"], $data[0]["bankroll"]);

    }

    /**
     * @throws Exception
     */
    public function update(Bankroll $bankroll): void
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new Exception("No connection to database.");
        }

        $data = $this->database->update("Bankroll", [
            "bankroll" => $bankroll->bankroll()
        ], [
            "id" => $bankroll->id()
        ]);

        if ($data->rowCount() < 1) {
            throw new Exception("Could not update bankroll");
        }
    }
}