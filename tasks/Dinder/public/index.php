<?php

use App\Controllers\ErrorController;
use App\Controllers\HomeController;
use App\Controllers\LikeController;
use App\Controllers\LoginController;
use App\Controllers\ProfileController;
use App\Controllers\SignUpController;
use App\Middlewares\ChangePasswordMiddleware;
use App\Middlewares\DataModificationIntegrityMiddleware;
use App\Middlewares\LoginMiddleware;
use App\Middlewares\RatingSaveMiddleware;
use App\Middlewares\SessionAuthenticationMiddleware;
use App\Middlewares\MiddlewareBuilder;
use App\Middlewares\SignUpMiddleware;
use App\Middlewares\UpdateProfileMiddleware;
use App\Repositories\History\HistoryRepository;
use App\Repositories\History\MySQLHistoryRepository;
use App\Repositories\Images\ImagesFSRepository;
use App\Repositories\Images\ImagesRepository;
use App\Repositories\Users\MySQLUserRepository;
use App\Repositories\Users\UserRepository;
use App\Services\Images\ImageDeleteService;
use App\Services\Images\ImageSaveService;
use App\Services\Login\LoginUserService;
use App\Services\Rating\PhotoRatingLoadService;
use App\Services\Rating\PhotoRatingSaveService;
use App\Services\Rating\PhotoResetService;
use App\Services\Users\ChangePasswordService;
use App\Services\Users\DeleteUserService;
use App\Services\Users\GetUserService;
use App\Services\Users\StoreUserService;
use App\Services\Users\UpdateUserService;
use Bootstrap\Request;
use Dotenv\Dotenv;
use FastRoute\Dispatcher;

require_once "../vendor/autoload.php";

/*** START SESSION ***/
session_start();


/*** ENVIRONMENT VARIABLES ***/
$dotenv = Dotenv::createImmutable("../");
$dotenv->load();


/*** CONTAINER ***/
$container = new League\Container\Container;
$container->add(LoginController::class)
    ->addArgument(LoginUserService::class);
$container->add(SignUpController::class)
    ->addArgument(StoreUserService::class)
    ->addArgument(LoginUserService::class);
$container->add(HomeController::class)
    ->addArgument(GetUserService::class)
    ->addArgument(PhotoRatingLoadService::class);
$container->add(ErrorController::class);
$container->add(UserRepository::class, MySQLUserRepository::class);
$container->add(HistoryRepository::class, MySQLHistoryRepository::class);
$container->add(ImagesRepository::class, ImagesFSRepository::class);
$container->add(LoginUserService::class)->addArgument(UserRepository::class);
$container->add(StoreUserService::class)->addArgument(UserRepository::class);
$container->add(UpdateUserService::class)->addArgument(UserRepository::class);
$container->add(GetUserService::class)->addArgument(UserRepository::class);
$container->add(ChangePasswordService::class)->addArgument(UserRepository::class);
$container->add(DeleteUserService::class)->addArgument(UserRepository::class);
$container->add(ImageSaveService::class)->addArgument(ImagesRepository::class);
$container->add(ImageDeleteService::class)->addArgument(ImagesRepository::class);
$container->add(PhotoResetService::class)->addArgument(HistoryRepository::class);
$container->add(PhotoRatingLoadService::class)
    ->addArgument(HistoryRepository::class)
    ->addArgument(UserRepository::class);
$container->add(PhotoRatingSaveService::class)
    ->addArgument(UserRepository::class)
    ->addArgument(HistoryRepository::class);
$container->add(ProfileController::class)
    ->addArgument(GetUserService::class)
    ->addArgument(DeleteUserService::class)
    ->addArgument(ChangePasswordService::class)
    ->addArgument(ImageSaveService::class)
    ->addArgument(ImageDeleteService::class)
    ->addArgument(UpdateUserService::class);
$container->add(LikeController::class)
    ->addArgument(PhotoRatingLoadService::class)
    ->addArgument(PhotoRatingSaveService::class)
    ->addArgument(GetUserService::class)
    ->addArgument(PhotoResetService::class);


/*** MIDDLEWARE ***/
$middleware = new MiddlewareBuilder();
$middleware->add(LoginController::class, "login", [LoginMiddleware::class]);
$middleware->add(SignUpController::class, "signup", [SignUpMiddleware::class]);
$middleware->add(HomeController::class, "home", [SessionAuthenticationMiddleware::class]);
$middleware->add(LikeController::class, "reset", [SessionAuthenticationMiddleware::class]);
$middleware->add(ProfileController::class, "profile", [SessionAuthenticationMiddleware::class]);
$middleware->add(ProfileController::class, "update", [
    SessionAuthenticationMiddleware::class,
    DataModificationIntegrityMiddleware::class,
    UpdateProfileMiddleware::class
]);
$middleware->add(ProfileController::class, "password", [
    SessionAuthenticationMiddleware::class,
    DataModificationIntegrityMiddleware::class,
    ChangePasswordMiddleware::class
]);
$middleware->add(ProfileController::class, "delete", [
    SessionAuthenticationMiddleware::class,
    DataModificationIntegrityMiddleware::class
]);
$middleware->add(LikeController::class, "like", [
    SessionAuthenticationMiddleware::class,
    RatingSaveMiddleware::class
]);


/*** ROUTES ***/
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->get("/", [LoginController::class, "index"]);
    $r->post("/login", [LoginController::class, "login"]);
    $r->get("/logout", [LoginController::class, "logout"]);
    $r->post("/signup", [SignUpController::class, "signup"]);
    $r->get("/home", [HomeController::class, "home"]);
    $r->get("/profile", [ProfileController::class, "profile"]);
    $r->post("/update", [ProfileController::class, "update"]);
    $r->post("/password", [ProfileController::class, "password"]);
    $r->post("/delete", [ProfileController::class, "delete"]);
    $r->post("/like", [LikeController::class, "like"]);
    $r->get("/reset", [LikeController::class, "reset"]);
    $r->get("/fourOFour", [ErrorController::class, "fourOFour"]);
});


/*** EXECUTE ROUTING ***/
$httpMethod = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

if ($routeInfo[0] === Dispatcher::NOT_FOUND) {
    echo $container->get(ErrorController::class)->fourOFour();
}

if ($routeInfo[0] === Dispatcher::METHOD_NOT_ALLOWED) {
    echo $container->get(ErrorController::class)->fourOFive();
}

$handler = $routeInfo[1];
$vars = $routeInfo[2];
[$controller, $method] = $handler;

$request = new Request();
if (isset($_GET)) {
    $request->fillInput($_GET, "g");
}

if (isset($_POST)) {
    $request->fillInput($_POST, "p");
}

if (isset($_FILES)) {
    $request->uploadFile($_FILES);
}

$middlewareKey = "{$controller}@{$method}";
$controllerMiddlewares = $middleware->get($middlewareKey);

foreach ($controllerMiddlewares as $controllerMiddleware) {
    (new $controllerMiddleware)->handle($request);
}

echo $container->get($controller)->$method($request);


/*** KILL INFO MESSAGE ***/
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION["_flash"])) {
    unset($_SESSION["_flash"]);
}