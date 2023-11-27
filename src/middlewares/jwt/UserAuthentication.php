<?php

/**
 * Use Proxy Pattern to validate the token
 */

namespace App\Middlewares\JWT;

use App\Services\UserService;
use App\Utils\JWT\JwtToken;

require_once 'src/services/UserService.php';

class UserAuthentication implements UserService {
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function getAll() : array {
        return $this->userService->getAll();
    }

    public function getById(int $id) : array {
        try {
            return $this->userService->getById($id);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function create($object) : array {
        if (!JwtToken::validateToken()) {
            throw new \Exception("Unauthorized");
        }
        return $this->userService->create($object);
    }

    public function update($object) : array {
        if (!JwtToken::validateToken()) {
            throw new \Exception("Unauthorized");
        }
        return $this->userService->update($object);
    }

    public function delete(int $id) : array {
        if (!JwtToken::validateToken()) {
            throw new \Exception("Unauthorized");
        }
        return $this->userService->delete($id);
    }
}