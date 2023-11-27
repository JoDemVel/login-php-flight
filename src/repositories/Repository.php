<?php

namespace App\Repositories;

interface Repository {
    public function getAll();
    public function getById(int $id);
    public function create($object);
    public function update($object);
    public function delete(int $id);
}