<?php

namespace App\Repositories\Shares;

use App\Models\Share;
use App\Models\ShareCollection;
use App\Repositories\MySQLAbstract;
use Exception;

class MySQLShareRepository extends MySQLAbstract implements ShareRepository
{
    /**
     * @throws Exception
     */
    public function getShares(): ShareCollection
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new Exception("No connection to database.");
        }
        $shares = new ShareCollection();
        $data = $this->database->select("Shares", "*");
        foreach ($data as $record) {
            $shares->addShare(new Share(
                $record["symbol"], $record["amount"], $record["priceOne"], $record["id"], $record["quote"],
                $record["project"], $record["purchase_date"], $record["status"], $record["profitState"]
            ));
        }

        return $shares;
    }

    /**
     * @throws Exception
     */
    public function getById(int $shareId): Share
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new Exception("No connection to database.");
        }
        $data = $this->database->select("Shares", "*", [
            "id" => $shareId,
            "LIMIT" => 1
        ]);

        if (count($data) !== 1) {
            throw new Exception("Share not found!");
        }
        return new Share(
            $data[0]["symbol"], $data[0]["amount"], $data[0]["priceOne"], $data[0]["id"], $data[0]["quote"],
            $data[0]["project"], $data[0]["purchase_date"], $data[0]["status"], $data[0]["profitState"]
        );
    }

    /**
     * @throws Exception
     */
    public function addShare(Share $share): int
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new Exception("No connection to database.");
        }

        $this->database->insert("Shares", [
            "symbol" => $share->symbol(),
            "amount" => $share->amount(),
            "priceOne" => $share->priceOne(),
            "quote" => $share->quote(),
            "project" => $share->project(),
            "status" => $share->status(),
            "profitState" => $share->profitState()
        ]);

        if ($this->database->id() === null) {
            throw new Exception("Something went wrong adding data. Please try again!");
        }

        return $this->database->id();
    }

    /**
     * @throws Exception
     */
    public function updateShares(ShareCollection $shares): void
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new Exception("No connection to database.");
        }

        foreach ($shares->shares() as $share) {
            /** @var Share $share */
            $data = $this->database->update("Shares", [
                "quote" => $share->quote(),
                "project" => $share->project(),
                "status" => $share->status(),
                "profitState" => $share->profitState()
            ], [
                "id" => $share->id()
            ]);

            if ($data->rowCount() < 1) {
                throw new Exception("Could not update bankroll");
            }
        }
    }

    /**
     * @throws Exception
     */
    public function updateOneShare(Share $share): void
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new Exception("No connection to database.");
        }

        $data = $this->database->update("Shares", [
            "quote" => $share->quote(),
            "project" => $share->project(),
            "status" => $share->status(),
            "profitState" => $share->profitState()
        ], [
            "id" => $share->id()
        ]);

        if ($data->rowCount() < 1) {
            throw new Exception("Could not update bankroll");
        }
    }
}