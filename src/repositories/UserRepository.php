<?php

namespace App\Repositories;
use App\Repositories\Repository;
use App\Config\DBConnection;
use PDO;

require_once 'src/config/DBConnection.php';
require_once 'src/repositories/Repository.php';

class UserRepository implements Repository{
    private PDO $db;

    public function __construct() {
        $this->db = DBConnection::getConnection();
    }

    public function getAll(): array {
        $query = "SELECT id, username, email, phone, status, rol_id FROM public.user";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $users;
    }

    public function getById(int $id): array {
        $query = "SELECT * FROM public.user WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if($user == false){
            throw new \Exception("User not found");
        }
        return $user;
    }

    public function create($object): array {
        $query = "INSERT INTO public.user (username, password, email, phone, status, rol_id) VALUES (:username, :password, :email, :phone, :status, :rol_id)";
        $stmt = $this->db->prepare($query);
        print_r($object);
        $stmt->bindParam(':username', $object['username']);
        $stmt->bindParam(':password', $object['password']);
        $stmt->bindParam(':email', $object['email']);
        $stmt->bindParam(':phone', $object['phone']);
        $stmt->bindParam(':status', $object['status']);
        $stmt->bindParam(':rol_id', $object['rol_id']);
        if (!$stmt->execute()) {
            throw new \Exception($stmt->errorInfo()[2]);
        }
        return [
            'id' => $this->db->lastInsertId(),
            'username' => $object['username'],
            'password' => $object['password'],
            'email' => $object['email'],
            'phone' => $object['phone'],
            'status' => $object['status'],
            'rol_id' => $object['rol_id']
        ];
    }

    public function update($object): array {
        $query = "UPDATE public.user SET username = :username, password = :password, email = :email, phone = :phone, status = :status, rol_id = :rol_id WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $object['id']);
        $stmt->bindParam(':username', $object['username']);
        $stmt->bindParam(':password', $object['password']);
        $stmt->bindParam(':email', $object['email']);
        $stmt->bindParam(':phone', $object['phone']);
        $stmt->bindParam(':status', $object['status']);
        $stmt->bindParam(':rol_id', $object['rol_id']);
        if(!$stmt->execute()) {
            throw new \Exception($stmt->errorInfo()[2]);
        }
        return $object;
    }

    public function delete(int $id): array {
        $user = $this->getById($id);
        $query = "DELETE FROM public.user WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        if(!$stmt->execute()) {
            throw new \Exception($stmt->errorInfo()[2]);
        }
        return $user;
    }
}