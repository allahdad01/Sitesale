<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class TeamMember
{
    public static function all(): array
    {
        $pdo = Database::connect();
        return $pdo->query("SELECT * FROM team_members WHERE active = 1 ORDER BY type ASC, sort_order ASC, id ASC")->fetchAll();
    }

    public static function allAdmin(): array
    {
        $pdo = Database::connect();
        return $pdo->query("SELECT * FROM team_members ORDER BY type ASC, sort_order ASC, id ASC")->fetchAll();
    }

    public static function lead(): array|false
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM team_members WHERE type = 'lead' AND active = 1 LIMIT 1");
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function members(): array
    {
        $pdo = Database::connect();
        return $pdo->query("SELECT * FROM team_members WHERE type = 'member' AND active = 1 ORDER BY sort_order ASC, id ASC")->fetchAll();
    }

    public static function find(int $id): array|false
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM team_members WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function create(array $data): int
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "INSERT INTO team_members (name, name_en, name_ps, name_fa, role, role_en, role_ps, role_fa, bio, bio_en, bio_ps, bio_fa, image, type, sort_order, active)
             VALUES (:name, :name_en, :name_ps, :name_fa, :role, :role_en, :role_ps, :role_fa, :bio, :bio_en, :bio_ps, :bio_fa, :image, :type, :sort_order, :active)"
        );
        $stmt->execute([
            'name'    => $data['name'] ?? '',
            'name_en' => $data['name_en'] ?? $data['name'] ?? '',
            'name_ps' => $data['name_ps'] ?? '',
            'name_fa' => $data['name_fa'] ?? '',
            'role'    => $data['role'] ?? '',
            'role_en' => $data['role_en'] ?? $data['role'] ?? '',
            'role_ps' => $data['role_ps'] ?? '',
            'role_fa' => $data['role_fa'] ?? '',
            'bio'     => $data['bio'] ?? '',
            'bio_en'  => $data['bio_en'] ?? $data['bio'] ?? '',
            'bio_ps'  => $data['bio_ps'] ?? '',
            'bio_fa'  => $data['bio_fa'] ?? '',
            'image'      => $data['image'] ?? '',
            'type'       => $data['type'] ?? 'member',
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
        foreach (['name', 'name_en', 'name_ps', 'name_fa', 'role', 'role_en', 'role_ps', 'role_fa', 'bio', 'bio_en', 'bio_ps', 'bio_fa', 'image', 'type', 'sort_order', 'active'] as $c) {
            if (array_key_exists($c, $data)) {
                $fields[] = "`$c` = :$c";
                $params[$c] = $data[$c];
            }
        }
        if (empty($fields)) return false;
        return $pdo->prepare("UPDATE team_members SET " . implode(', ', $fields) . " WHERE id = :id")->execute($params);
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::connect();
        return $pdo->prepare("DELETE FROM team_members WHERE id = :id")->execute(['id' => $id]);
    }

    public static function maxSortOrder(): int
    {
        $pdo = Database::connect();
        return (int) $pdo->query("SELECT COALESCE(MAX(sort_order), -1) FROM team_members")->fetchColumn();
    }
}
