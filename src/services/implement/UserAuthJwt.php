<?php

namespace App\Services\Implement;

use App\Config\DBConnection;
use App\Services\UserAuth;
use App\Utils\JWT\JwtToken;

require_once 'src/config/DBConnection.php';
require_once 'src/services/UserAuth.php';
require_once 'src/utils/jwt/JwtToken.php';

class UserAuthJwt implements UserAuth {
    private static ?UserAuthJwt $instance = null;

    private function __construct() {}

    public static function getInstance() : UserAuthJwt {
        if (self::$instance == null) {
            self::$instance = new UserAuthJwt();
        }
        return self::$instance;
    }

    public function login($username, $password) : array {
        $db = DBConnection::getConnection();

        $query = $db->prepare("SELECT id, username, email, phone, status, rol_id FROM public.user WHERE username = :username AND password = :password");

        $array = [
            "error" => "Error al autenticar el usuario",
            "status" => "Error"
        ];

        if ($query->execute([":username" => $username, ":password" => $password])) {
            $user = $query->fetch();
            if ($user) {
                $jwt = JwtToken::genToken($user['id']);
                $array = ["token" => $jwt];
            } else {
                $array = [
                    "error" => "Credenciales incorrectas",
                    "status" => "Error"
                ];
            }
        }
        return $array;
    }
}