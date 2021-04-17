<?php

use App\Controllers\ErrorController;
use App\Controllers\HomeController;
use App\Controllers\ShareController;
use App\Controllers\TradeShareController;
use App\Repositories\Balance\BankrollRepository;
use App\Repositories\Balance\MySQLBankrollRepository;
use App\Repositories\Finnhub\APIFinnhubRepository;
use App\Repositories\Finnhub\FinnhubRepository;
use App\Repositories\Shares\MySQLShareRepository;
use App\Repositories\Shares\ShareRepository;
use App\Services\Bankroll\BankrollService;
use App\Services\Shares\GetShareService;
use App\Services\Shares\BuyShareService;
use App\Services\Shares\SellShareService;
use Bootstrap\Route;
use Dotenv\Dotenv;

require_once "../vendor/autoload.php";

/*** ENVIRONMENT VARIABLES ***/
$dotenv = Dotenv::createImmutable("../");
$dotenv->load();


/*** CONTAINER ***/
$container = new League\Container\Container;
$container->add(ErrorController::class, ErrorController::class);
$container->add(BankrollRepository::class, MySQLBankrollRepository::class);
$container->add(HomeController::class, HomeController::class)
    ->addArgument(BankrollService::class)
    ->addArgument(GetShareService::class);
$container->add(BankrollService::class, BankrollService::class)
    ->addArgument(BankrollRepository::class);
$container->add(ShareRepository::class, MySQLShareRepository::class);
$container->add(FinnhubRepository::class, APIFinnhubRepository::class);
$container->add(BuyShareService::class, BuyShareService::class)
    ->addArgument(ShareRepository::class)
    ->addArgument(BankrollRepository::class);
$container->add(SellShareService::class, SellShareService::class)
    ->addArgument(ShareRepository::class)
    ->addArgument(BankrollRepository::class);
$container->add(GetShareService::class, GetShareService::class)
    ->addArgument(ShareRepository::class)
    ->addArgument(FinnhubRepository::class);
$container->add(ShareController::class, ShareController::class)
    ->addArgument(GetShareService::class)
    ->addArgument(BankrollService::class);
$container->add(TradeShareController::class, TradeShareController::class)
    ->addArgument(BuyShareService::class)
    ->addArgument(GetShareService::class)
    ->addArgument(BankrollService::class)
    ->addArgument(SellShareService::class);

/*** ROUTING ***/
// Routes
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->get("/", [HomeController::class, "index"]);
    $r->get("/home", [HomeController::class, "home"]);
    $r->get("/lookup", [ShareController::class, "lookup"]);
    $r->get("/add", [ShareController::class, "add"]);
    $r->get("/refresh", [ShareController::class, "refresh"]);
    $r->get("/buyShare", [TradeShareController::class, "buyShare"]);
    $r->get("/sellShare", [TradeShareController::class, "sellShare"]);
});

echo Route::route($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $dispatcher, $container);