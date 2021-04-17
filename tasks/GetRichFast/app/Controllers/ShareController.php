<?php

namespace App\Controllers;

use App\Services\Bankroll\BankrollService;
use App\Services\Shares\GetShareService;
use Exception;

class ShareController extends Controller
{
    private GetShareService $getShareService;
    private BankrollService $bankrollService;

    public function __construct(GetShareService $getShareService, BankrollService $bankrollService)
    {
        $this->getShareService = $getShareService;
        $this->bankrollService = $bankrollService;
    }

    public function lookup(): string
    {
        if (empty($_GET)) {
            $this->tableMessage = "Something went wrong. Please try again.";
            header("Content-type: application/json");
            return json_encode(array("0", $this->tableMessage));
        }

        $search = trim($_GET["search"]);

        try {
            $lookup = $this->getShareService->lookup($search);
        } catch (Exception $exception) {
            $this->tableMessage = $exception->getMessage();
            header("Content-type: application/json");
            return json_encode(array("0", $this->tableMessage));
        }

        $count = count($lookup);

        if ($count < 1) {
            $this->tableMessage = "There are no matching stock units available.";
            header("Content-type: application/json");
            return json_encode(array("0", $this->tableMessage));
        }

        $this->tableMessage = "&nbsp;";
        header("Content-type: application/json");
        return json_encode(array("1", $lookup));
    }

    public function refresh(): string
    {
        try {
            $stock = $this->getShareService->stock();
            $bankroll = $this->bankrollService->getById(1);
        } catch (Exception $exception) {
            $this->tableMessage = $exception->getMessage();
            header("Content-type: application/json");
            return json_encode(array("0", $this->tableMessage));
        }

        header("Content-type: application/json");
        return json_encode(array("1", $stock, $bankroll));
    }
}