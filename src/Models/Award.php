<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Award
{
    public static function all(): array
    {
        $pdo = Database::connect();
        return $pdo->query("SELECT * FROM awards WHERE active = 1 ORDER BY sort_order ASC, id ASC")->fetchAll();
    }

    public static function allAdmin(): array
    {
        $pdo = Database::connect();
        return $pdo->query("SELECT * FROM awards ORDER BY sort_order ASC, id ASC")->fetchAll();
    }

    public static function find(int $id): array|false
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM awards WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function create(array $data): int
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "INSERT INTO awards (image, label, sort_order, active) VALUES (:image, :label, :sort_order, :active)"
        );
        $stmt->execute([
            'image'      => $data['image'] ?? '',
            'label'      => $data['label'] ?? '',
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
        foreach (['image', 'label', 'sort_order', 'active'] as $c) {
            if (array_key_exists($c, $data)) {
                $fields[] = "`$c` = :$c";
                $params[$c] = $data[$c];
            }
        }
        if (empty($fields)) return false;
        return $pdo->prepare("UPDATE awards SET " . implode(', ', $fields) . " WHERE id = :id")->execute($params);
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::connect();
        return $pdo->prepare("DELETE FROM awards WHERE id = :id")->execute(['id' => $id]);
    }

    public static function maxSortOrder(): int
    {
        $pdo = Database::connect();
        return (int) $pdo->query("SELECT COALESCE(MAX(sort_order), -1) FROM awards")->fetchColumn();
    }
}
