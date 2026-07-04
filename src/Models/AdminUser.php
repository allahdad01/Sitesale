<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class AdminUser
{
    public static function findByUsername(string $username): array|false
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id): array|false
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    public static function create(string $username, string $email, string $password): bool
    {
        $pdo = Database::connect();
        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $pdo->prepare(
            "INSERT INTO admin_users (username, email, password) VALUES (:username, :email, :password)"
        );
        return $stmt->execute([
            'username' => $username,
            'email'    => $email,
            'password' => $hash,
        ]);
    }

    public static function count(): int
    {
        $pdo = Database::connect();
        return (int) $pdo->query("SELECT COUNT(*) FROM admin_users")->fetchColumn();
    }
}
