<?php

namespace App\Services;

interface UserService {
    public function getAll() : array;
    public function getById(int $id) : array;
    public function create($object) : array;
    public function update($object) : array;
    public function delete(int $id) : array;
}