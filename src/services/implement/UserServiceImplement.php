<?php

namespace App\Services\Implement;

use App\Services\UserService;
use App\Repositories\UserRepository;

require_once 'src/services/UserService.php';
require_once 'src/repositories/UserRepository.php';

class UserServiceImplement implements UserService {
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getAll(): array {
        return $this->userRepository->getAll();
    }

    public function getById(int $id): array {
        try {
            $user = $this->userRepository->getById($id);
            if($user == false){
                throw new \Exception("User not found");
            }
            return $user;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function create($object): array{
        try {
            return $this->userRepository->create($object);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update($object): array {
        try {
            return $this->userRepository->update($object);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function delete(int $id): array{
        try {
            return $this->userRepository->delete($id);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}