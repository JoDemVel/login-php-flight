<?php

namespace App\Services;

interface UserAuth {
    public function login($username, $password) : array;
}