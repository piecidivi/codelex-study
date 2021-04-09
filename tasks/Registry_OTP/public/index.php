<?php

require_once "../vendor/autoload.php";

use App\Controllers\ErrorController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\PersonController;
use App\Repositories\Persons\MySQLPersonRepository;
use App\Repositories\Persons\PersonRepository;
use App\Repositories\Tokens\MySQLTokenRepository;
use App\Repositories\Tokens\TokenRepository;
use App\Services\Persons\StorePersonService;
use App\Services\Tokens\TokenService;
use Bootstrap\Route;
use Dotenv\Dotenv;


/*** START SESSION ***/
session_start();


/*** ENVIRONMENT VARIABLES ***/
$dotenv = Dotenv::createImmutable("../");
$dotenv->load();


/*** CONTAINER ***/
$container = new League\Container\Container;
$container->add(PersonRepository::class, MySQLPersonRepository::class);
$container->add(StorePersonService::class, StorePersonService::class)->addArgument(PersonRepository::class);
$container->add(PersonController::class, PersonController::class)->addArgument(StorePersonService::class);
$container->add(HomeController::class, HomeController::class);
$container->add(TokenRepository::class, MySQLTokenRepository::class);
$container->add(TokenService::class, TokenService::class)->addArgument(PersonRepository::class)
    ->addArgument(TokenRepository::class);
$container->add(ErrorController::class, ErrorController::class);
$container->add(LoginController::class, LoginController::class)->addArgument(TokenService::class);


/*** ROUTING ***/
// Routes
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->get("/", [HomeController::class, "index"]);
    $r->get("/home", [HomeController::class, "home"]);
    $r->get("/get", [PersonController::class, "get"]);
    $r->get("/getById", [PersonController::class, "getById"]);
    $r->get("/add", [PersonController::class, "add"]);
    $r->post("/detail", [PersonController::class, "detail"]);
    $r->get("/access", [LoginController::class, "access"]);
    $r->get("/login", [LoginController::class, "login"]);
    $r->get("/logout", [LoginController::class, "logout"]);
});

Route::route($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $dispatcher, $container);