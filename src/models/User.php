<?php

namespace App\Models;

use App\Utils\Builder\UserBuilder;
use App\Models\Model;

require_once 'src/utils/builder/UserBuilder.php';
require_once 'src/models/Model.php';

class User implements Model{
    private int $id;
    private string $username;
    private string $password;
    private string $email;
    private string $phone;
    private bool $status;
    private int $rol_id;

    public function __construct() {
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUserame(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function getStatus(): bool {
        return $this->status;
    }

    public function getRolId(): int {
        return $this->rol_id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPhone(string $phone): void {
        $this->phone = $phone;
    }

    public function setStatus(bool $status): void {
        $this->status = $status;
    }

    public function setRoleId(int $rol_id): void {
        $this->rol_id = $rol_id;
    }

    public function toArray(): array {
        return [
            'id' => $this->id ?? null,
            'username' => $this->username,
            'password' => $this->password,
            'email' => $this->email,
            'phone' => $this->phone ?? null,
            'status' => $this->status ?? null,
            'rol_id' => $this->rol_id ?? null
        ];
    }

    public static function builder(): UserBuilder {
        return new UserBuilder(new User());
    }
}