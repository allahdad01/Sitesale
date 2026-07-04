<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class PageSection
{
    public static function getActive(string $page = 'home'): array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "SELECT * FROM page_sections WHERE page = :page AND active = 1 ORDER BY sort_order ASC"
        );
        $stmt->execute(['page' => $page]);
        return $stmt->fetchAll();
    }

    public static function all(string $page = 'home'): array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "SELECT * FROM page_sections WHERE page = :page ORDER BY sort_order ASC"
        );
        $stmt->execute(['page' => $page]);
        return $stmt->fetchAll();
    }

    public static function find(int $id): array|false
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM page_sections WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function create(array $data): int
    {
        $pdo = Database::connect();

        $sortOrder = (int) ($data['sort_order'] ?? -1);
        if ($sortOrder < 0) {
            $maxOrder = $pdo->prepare("SELECT COALESCE(MAX(sort_order), -1) + 1 FROM page_sections WHERE page = :page");
            $maxOrder->execute(['page' => $data['page'] ?? 'home']);
            $sortOrder = (int) $maxOrder->fetchColumn();
        }

        $stmt = $pdo->prepare(
            "INSERT INTO page_sections (page, section_key, label, type, content, sort_order, active)
             VALUES (:page, :section_key, :label, :type, :content, :sort_order, :active)"
        );
        $stmt->execute([
            'page'        => $data['page'] ?? 'home',
            'section_key' => $data['section_key'],
            'label'       => $data['label'] ?? '',
            'type'        => $data['type'] ?? 'custom_html',
            'content'     => $data['content'] ?? '',
            'sort_order'  => $sortOrder,
            'active'      => $data['active'] ?? 1,
        ]);
        return (int) $pdo->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $pdo = Database::connect();
        $fields = [];
        $params = ['id' => $id];

        foreach (['label', 'type', 'content', 'section_key', 'active', 'sort_order'] as $col) {
            if (array_key_exists($col, $data)) {
                $fields[] = "`$col` = :$col";
                $params[$col] = $data[$col];
            }
        }

        if (empty($fields)) {
            return false;
        }

        $sql = "UPDATE page_sections SET " . implode(', ', $fields) . " WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public static function toggle(int $id): bool
    {
        $section = self::find($id);
        if (!$section) return false;

        return self::update($id, ['active' => $section['active'] ? 0 : 1]);
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM page_sections WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public static function reorder(array $order): void
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE page_sections SET sort_order = :sort_order WHERE id = :id");
        foreach ($order as $id => $pos) {
            $stmt->execute(['id' => (int) $id, 'sort_order' => (int) $pos]);
        }
    }

    public static function activeKeys(string $page = 'home'): array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "SELECT section_key FROM page_sections WHERE page = :page AND active = 1 ORDER BY sort_order ASC"
        );
        $stmt->execute(['page' => $page]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
