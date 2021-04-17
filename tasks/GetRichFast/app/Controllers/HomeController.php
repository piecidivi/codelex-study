<?php

namespace App\Controllers;

use App\Services\Bankroll\BankrollService;
use App\Services\Shares\GetShareService;
use App\Views\View;
use Exception;

class HomeController extends Controller
{
    private BankrollService $bankrollService;
    private GetShareService $getShareService;

    public function __construct(BankrollService $bankrollService, GetShareService $getShareService)
    {
        $this->bankrollService = $bankrollService;
        $this->getShareService = $getShareService;
    }

    public function index(): string
    {
        $this->tableMessage = "&nbsp;";

        try {
            $bankroll = $this->bankrollService->getById(1);
            $stock = $this->getShareService->stock();
        } catch (Exception $exception) {
            $this->tableMessage = $exception->getMessage();
            return View::output("home.php.twig", [
                "tableMessage" => $this->tableMessage
            ]);
        }

        return View::output("home.php.twig", [
            "tableMessage" => $this->tableMessage,
            "bankroll" => $bankroll,
            "stock" => $stock
        ]);
    }
}