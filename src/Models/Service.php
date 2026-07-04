<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Service
{
    public static function all(): array
    {
        $pdo = Database::connect();
        return $pdo->query("SELECT * FROM services WHERE active = 1 ORDER BY sort_order ASC, id ASC")->fetchAll();
    }

    public static function allAdmin(): array
    {
        $pdo = Database::connect();
        return $pdo->query("SELECT * FROM services ORDER BY sort_order ASC, id ASC")->fetchAll();
    }

    public static function find(int $id): array|false
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM services WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function create(array $data): int
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "INSERT INTO services (title, tag, description, image, link, sort_order, active)
             VALUES (:title, :tag, :description, :image, :link, :sort_order, :active)"
        );
        $stmt->execute([
            'title'       => $data['title'] ?? '',
            'tag'         => $data['tag'] ?? '',
            'description' => $data['description'] ?? '',
            'image'       => $data['image'] ?? '',
            'link'        => $data['link'] ?? '',
            'sort_order'  => (int) ($data['sort_order'] ?? 0),
            'active'      => (int) ($data['active'] ?? 1),
        ]);
        return (int) $pdo->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $pdo = Database::connect();
        $fields = [];
        $params = ['id' => $id];
        foreach (['title', 'tag', 'description', 'image', 'link', 'sort_order', 'active'] as $c) {
            if (array_key_exists($c, $data)) {
                $fields[] = "`$c` = :$c";
                $params[$c] = $data[$c];
            }
        }
        if (empty($fields)) return false;
        return $pdo->prepare("UPDATE services SET " . implode(', ', $fields) . " WHERE id = :id")->execute($params);
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::connect();
        return $pdo->prepare("DELETE FROM services WHERE id = :id")->execute(['id' => $id]);
    }

    public static function maxSortOrder(): int
    {
        $pdo = Database::connect();
        return (int) $pdo->query("SELECT COALESCE(MAX(sort_order), -1) FROM services")->fetchColumn();
    }
}
