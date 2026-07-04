<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Testimonial
{
    public static function all(): array
    {
        $pdo = Database::connect();
        return $pdo->query("SELECT * FROM testimonials WHERE active = 1 ORDER BY sort_order ASC, id ASC")->fetchAll();
    }

    public static function allAdmin(): array
    {
        $pdo = Database::connect();
        return $pdo->query("SELECT * FROM testimonials ORDER BY sort_order ASC, id ASC")->fetchAll();
    }

    public static function find(int $id): array|false
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM testimonials WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function create(array $data): int
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "INSERT INTO testimonials (name, position, content, rating, avatar, sort_order, active)
             VALUES (:name, :position, :content, :rating, :avatar, :sort_order, :active)"
        );
        $stmt->execute([
            'name'       => $data['name'] ?? '',
            'position'   => $data['position'] ?? '',
            'content'    => $data['content'] ?? '',
            'rating'     => (int) ($data['rating'] ?? 5),
            'avatar'     => $data['avatar'] ?? '',
            'sort_order' => (int) ($data['sort_order'] ?? 0),
            'active'     => (int) ($data['active'] ?? 1),
        ]);
        return (int) $pdo->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $pdo = Database::connect();
        $fields = [];
        $params = ['id' => $id];
        foreach (['name', 'position', 'content', 'rating', 'avatar', 'sort_order', 'active'] as $c) {
            if (array_key_exists($c, $data)) {
                $fields[] = "`$c` = :$c";
                $params[$c] = $data[$c];
            }
        }
        if (empty($fields)) return false;
        return $pdo->prepare("UPDATE testimonials SET " . implode(', ', $fields) . " WHERE id = :id")->execute($params);
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::connect();
        return $pdo->prepare("DELETE FROM testimonials WHERE id = :id")->execute(['id' => $id]);
    }

    public static function maxSortOrder(): int
    {
        $pdo = Database::connect();
        return (int) $pdo->query("SELECT COALESCE(MAX(sort_order), -1) FROM testimonials")->fetchColumn();
    }
}
