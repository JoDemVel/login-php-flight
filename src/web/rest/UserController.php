<?php

namespace App\Web\Rest;

use App\Middlewares\JWT\UserAuthentication;
use App\Web\Rest\Controller;
use App\Models\User;

require_once 'src/middlewares/jwt/UserAuthentication.php';
require_once 'src/web/rest/Controller.php';
require_once 'src/models/User.php';

use Flight;

class UserContoller implements Controller{
    private UserAuthentication $userAuthentication;

    public function __construct(UserAuthentication $userAuthentication) {
        $this->userAuthentication = $userAuthentication;
    }

    public function getAll() {
        try {
            $users = $this->userAuthentication->getAll();
            Flight::json($users, 200);
        } catch (\Exception $e) {
            Flight::halt(500, json_encode([ "error" => $e->getMessage()]));
        }
    }

    public function getById(int $id) {
        try {
            $user = $this->userAuthentication->getById($id);
            Flight::json($user, 200);
        } catch (\Exception $e) {
            Flight::halt(500, json_encode([ "error" => $e->getMessage()]));
        }
    }

    public function create() {
        try {
            $user = Flight::request()->data->getData();
            $user = $this->userAuthentication->create($user);
            Flight::json($user, 201);
        } catch (\Exception $e) {
            if($e->getMessage() == "Unauthorized")
                Flight::halt(403, json_encode([ "error" => $e->getMessage()]));
            Flight::halt(500, json_encode([ "error" => $e->getMessage()]));
        }
    }

    public function update() {
        try {
            $user = Flight::request()->data->getData();
            $user = $this->userAuthentication->update($user);
            Flight::json($user, 200);
        } catch (\Exception $e) {
            if($e->getMessage() == "Unauthorized")
                Flight::halt(403, json_encode([ "error" => $e->getMessage()]));
            Flight::halt(500, json_encode([ "error" => $e->getMessage()]));
        }
    }

    public function delete(int $id) {
        try {
            $user = $this->userAuthentication->delete($id);
            Flight::json($user, 204);
        } catch (\Exception $e) {
            if($e->getMessage() == "Unauthorized")
                Flight::halt(403, json_encode([ "error" => $e->getMessage()]));
            Flight::halt(500, json_encode([ "error" => $e->getMessage()]));
        }
    }
}