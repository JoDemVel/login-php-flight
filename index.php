<?php

use App\Utils\Factory\UserControllerFactory;
use App\Services\Implement\UserAuthJwt;

require_once 'vendor/autoload.php';
require_once 'src/utils/factory/UserControllerFactory.php';
require_once 'src/services/implement/UserAuthJwt.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");

Flight::route('GET /users', function() {
    $userControllerFactory = new UserControllerFactory();
    $userController = $userControllerFactory->create();
    $users = $userController->getAll();
});

Flight::route('GET /users/@id', function($id) {
    $userControllerFactory = new UserControllerFactory();
    $userController = $userControllerFactory->create();
    $userController->getById($id);
});

Flight::route('POST /users', function() {
    $userControllerFactory = new UserControllerFactory();
    $userController = $userControllerFactory->create();
    $userController->create();
});

Flight::route('PUT /users', function() {
    $userControllerFactory = new UserControllerFactory();
    $userController = $userControllerFactory->create();
    $userController->update();
});

Flight::route('DELETE /users/@id', function($id) {
    $userControllerFactory = new UserControllerFactory();
    $userController = $userControllerFactory->create();
    $userController->delete($id);
});

Flight::route('POST /auth', function() {
    $userAuthJwt = UserAuthJwt::getInstance();
    $username = Flight::request()->data->username;
    $password = Flight::request()->data->password;
    $res = $userAuthJwt->login($username, $password);
    Flight::halt(200, json_encode($res));
});

Flight::route('OPTIONS /auth', function(){
    Flight::json(["message" => "ok"], 200);
});

Flight::start();