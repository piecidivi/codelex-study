<?php

require_once "../vendor/autoload.php";

use App\Controllers\HomeController;
use App\Controllers\PersonController;
use App\Repositories\Persons\MySQLPersonRepository;
use App\Repositories\Persons\PersonRepository;
use App\Services\Persons\StorePersonService;
use Dotenv\Dotenv;


/*** ENVIRONMENT VARIABLES ***/
$dotenv = Dotenv::createImmutable("../");
$dotenv->load();


/*** CONTAINER ***/
$container = new League\Container\Container;
$container->add(PersonRepository::class, MySQLPersonRepository::class);
$container->add(StorePersonService::class, StorePersonService::class)->addArgument(PersonRepository::class);
$container->add(PersonController::class, PersonController::class)->addArgument(StorePersonService::class);
$container->add(HomeController::class, HomeController::class);  // bind to itself


/*** ROUTING ***/
// Routes
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->get("/", [HomeController::class, "index"]);
    $r->get("/get", [PersonController::class, "get"]);
    $r->get("/getById", [PersonController::class, "getById"]);
    $r->get("/add", [PersonController::class, "add"]);
    $r->post("/detail", [PersonController::class, "detail"]);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$controller, $method] = $handler;
        echo ($container->get($controller))->$method($vars);
        // ... call $handler with $vars
        break;
}