<?php

namespace App\Utils\JWT;

use App\Config\DBConnection;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use Flight;
use Throwable;

# require_once 'vendor/autoload.php';

require_once 'src/config/DBConnection.php';

class JwtToken {
    public static function genToken(int $id){
        $key = $_ENV["JWT_KEY"];
        $algorthm = $_ENV["JWT_ALGORTHM"];
        $minutes = $_ENV["JWT_EXPIRE_MINUTES"];
        $time = time();
        $payload = [
            "iat" => $time,
            "exp" => $time + (60 * $minutes),
            "data" => $id
        ];
        $token = JWT::encode($payload, $key, $algorthm);
        return $token;
    }

    public static function getToken(){
        $headers = apache_request_headers();
        if(!isset($headers["Authorization"])){
            Flight::halt(403, json_encode([
                "error" => "Unauthorized",
                "status" => "error"
            ]));
        }
        $authorization = $headers["Authorization"];
        $authorization = $headers["Authorization"];
        $authorizationArray = explode(" ", $authorization);
        $token = $authorizationArray[1];
        try {
            $key = $_ENV["JWT_KEY"];
            $algorthm = $_ENV["JWT_ALGORTHM"];
            $decoded = JWT::decode($token, new Key($key, $algorthm));
        } catch (Throwable $th) {
            Flight::halt(403, json_encode([
                "error" => $th -> getMessage(),
                "status" => "error"
            ]));
        }
        return $decoded;
    }

    public static function validateToken(){
        $info = self::getToken();
        $db = DBConnection::getConnection();
        $query = $db->prepare("SELECT * FROM public.user WHERE id = :id");
        $query->execute([":id" => $info->data]);
        $row = $query->fetchColumn();
        return $row;
    }

    public static function validateTokenAdmin(){
        $info = self::getToken();
        $db = DBConnection::getConnection();
        $query = $db->prepare("SELECT * FROM public.user WHERE id = :id AND role_id = 1");
        $query->execute([":id" => $info->data]);
        $row = $query->fetchColumn();
        return $row;
    }

    public static function validateTokenUser(){
        $info = self::getToken();
        $db = DBConnection::getConnection();
        $query = $db->prepare("SELECT * FROM public.user WHERE id = :id AND role_id = 2");
        $query->execute([":id" => $info->data]);
        $row = $query->fetchColumn();
        return $row;
    }
}