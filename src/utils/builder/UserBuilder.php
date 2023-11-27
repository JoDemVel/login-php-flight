<?php

namespace App\Utils\Builder;

use App\Models\User;

class UserBuilder {
    private User $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function id(int $id): UserBuilder {
        $this->user->setId($id);
        return $this;
    }

    public function username(string $username): UserBuilder {
        $this->user->setUsername($username);
        return $this;
    }

    public function password(string $password): UserBuilder {
        $this->user->setPassword($password);
        return $this;
    }

    public function email(string $email): UserBuilder {
        $this->user->setEmail($email);
        return $this;
    }

    public function phone(string $phone): UserBuilder {
        $this->user->setPhone($phone);
        return $this;
    }

    public function status(bool $status): UserBuilder {
        $this->user->setStatus($status);
        return $this;
    }

    public function rol_id(int $rol_id): UserBuilder {
        $this->user->setRoleId($rol_id);
        return $this;
    }

    public function build(): User {
        return $this->user;
    }
}