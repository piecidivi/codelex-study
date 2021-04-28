<?php

namespace App\Repositories\History;

use App\Models\History;
use App\Models\HistoryCollection;
use App\Repositories\MySQLAbstract;
use Exception;
use InvalidArgumentException;

class MySQLHistoryRepository extends MySQLAbstract implements HistoryRepository
{
    /**
     * @throws \Exception
     */
    public function addRecord(History $history, int $userid): void
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new Exception("No connection to database.");
        }

        $this->database->insert("History", [
            "userid" => $userid,
            "checked_id" => $history->checkedId(),
            "checked_name" => $history->checkedName(),
            "liked" => $history->liked()
        ]);

        if ($this->database->id() === null) {
            throw new Exception("Something went wrong adding data. Please try again!");
        }
    }

    /**
     * @throws \Exception
     */
    public function getHistoryByUserId(int $userid): HistoryCollection
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new Exception("No connection to database.");
        }

        $historyCollection = new HistoryCollection();
        $data = $this->database->select("History", "*", [
            "userid" => $userid
        ]);

        foreach ($data as $record) {
            $historyCollection->addHistory(new History(
                $record["userid"], $record["checked_id"],
                $record["checked_name"], $record["liked"],
                $record["id"], $record["created"]
            ));
        }
        return $historyCollection;
    }

    /**
     * @throws \Exception
     */
    public function resetHistoryById(int $userid): void
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new Exception("No connection to database.");
        }

        $delete = $this->database->delete("History", [
            "userid" => $userid
        ]);

        if ($delete->rowCount() < 1) {
            throw new InvalidArgumentException("User ID not found.");
        }
    }
}