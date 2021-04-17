<?php

namespace App\Controllers;

use App\Services\Bankroll\BankrollService;
use App\Services\Shares\BuyShareService;
use App\Services\Shares\GetShareService;
use App\Services\Shares\SellShareService;
use Exception;

class TradeShareController extends Controller
{
    private BuyShareService $buyShareService;
    private GetShareService $getShareService;
    private BankrollService $bankrollService;
    private SellShareService $sellShareService;

    public function __construct(
        BuyShareService $buyShareService,
        GetShareService $getShareService,
        BankrollService $bankrollService,
        SellShareService $sellShareService
    )
    {
        $this->buyShareService = $buyShareService;
        $this->getShareService = $getShareService;
        $this->bankrollService = $bankrollService;
        $this->sellShareService = $sellShareService;
    }

    public function buyShare(): string
    {
        if (empty($_GET)) {
            $this->tableMessage = "Something went wrong. Please try again.";
            header("Content-type: application/json");
            return json_encode(array("0", $this->tableMessage));
        }

        $bankrollId = intval($_GET["bankrollId"]);
        $symbol = $_GET["symbol"];
        $price = floatval($_GET["price"]);
        $amount = intval($_GET["amount"]);

        if (!preg_match('/^\d+$/', $amount)) {
            $this->tableMessage = "Invalid amount provided. Better luck next time.";
            header("Content-type: application/json");
            return json_encode(array("0", $this->tableMessage));
        }

        try {
            $this->buyShareService->buy($bankrollId, $symbol, $amount, $price);
        } catch (Exception $exception) {
            $this->tableMessage = $exception->getMessage();
            header("Content-type: application/json");
            return json_encode(array("0", $this->tableMessage));
        }

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

    public function sellShare(): string
    {
        if (empty($_GET)) {
            $this->tableMessage = "Something went wrong. Please try again.";
            header("Content-type: application/json");
            return json_encode(array("0", $this->tableMessage));
        }

        $bankrollId = intval($_GET["bankrollId"]);
        $shareId = intval($_GET["shareId"]);
        $price = floatval($_GET["price"]);

        try {
            $this->sellShareService->sell($bankrollId, $shareId, $price);
        } catch (Exception $exception) {
            $this->tableMessage = $exception->getMessage();
            header("Content-type: application/json");
            return json_encode(array("0", $this->tableMessage));
        }

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