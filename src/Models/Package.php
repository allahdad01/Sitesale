<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Package
{
    public static function all(string $category = '', int $limit = 0): array
    {
        $pdo = Database::connect();
        $sql = "SELECT * FROM packages WHERE active = 1";
        $params = [];

        if ($category) {
            $sql .= " AND category = :category";
            $params['category'] = $category;
        }

        $sql .= " ORDER BY featured DESC, created_at DESC";

        if ($limit > 0) {
            $sql .= " LIMIT :lim";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue('lim', $limit, PDO::PARAM_INT);
        } else {
            $stmt = $pdo->prepare($sql);
        }

        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function featured(int $limit = 6): array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "SELECT * FROM packages WHERE active = 1 AND featured = 1 ORDER BY created_at DESC LIMIT :lim"
        );
        $stmt->bindValue('lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function findBySlug(string $slug): array|false
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM packages WHERE slug = :slug AND active = 1 LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetch();
    }

    public static function find(int $id): array|false
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM packages WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function create(array $data): int
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "INSERT INTO packages (title, slug, description, image, price, duration_days, max_people, category, destination, featured, active)
             VALUES (:title, :slug, :description, :image, :price, :duration_days, :max_people, :category, :destination, :featured, :active)"
        );
        $stmt->execute([
            'title'         => $data['title'],
            'slug'          => $data['slug'] ?? self::slugify($data['title']),
            'description'   => $data['description'] ?? '',
            'image'         => $data['image'] ?? null,
            'price'         => $data['price'] ?? 0,
            'duration_days' => $data['duration_days'] ?? 1,
            'max_people'    => $data['max_people'] ?? 1,
            'category'      => $data['category'] ?? 'tour',
            'destination'   => $data['destination'] ?? null,
            'featured'      => $data['featured'] ?? 0,
            'active'        => $data['active'] ?? 1,
        ]);
        return (int) $pdo->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $pdo = Database::connect();
        $fields = [];
        $params = ['id' => $id];
        $cols = ['title', 'slug', 'description', 'image', 'price', 'duration_days', 'max_people', 'category', 'destination', 'featured', 'active'];

        foreach ($cols as $c) {
            if (array_key_exists($c, $data)) {
                $fields[] = "`$c` = :$c";
                $params[$c] = $data[$c];
            }
        }

        if (empty($fields)) return false;
        $sql = "UPDATE packages SET " . implode(', ', $fields) . " WHERE id = :id";
        return $pdo->prepare($sql)->execute($params);
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::connect();
        return $pdo->prepare("DELETE FROM packages WHERE id = :id")->execute(['id' => $id]);
    }

    public static function toggle(int $id): bool
    {
        $pkg = self::find($id);
        if (!$pkg) return false;
        return self::update($id, ['active' => $pkg['active'] ? 0 : 1]);
    }

    public static function toggleFeatured(int $id): bool
    {
        $pkg = self::find($id);
        if (!$pkg) return false;
        return self::update($id, ['featured' => $pkg['featured'] ? 0 : 1]);
    }

    public static function allAdmin(): array
    {
        $pdo = Database::connect();
        return $pdo->query("SELECT * FROM packages ORDER BY created_at DESC")->fetchAll();
    }

    public static function slugify(string $text): string
    {
        $text = preg_replace('/[^a-zA-Z0-9\s-]/', '', $text);
        $text = preg_replace('/[\s-]+/', '-', trim($text));
        return strtolower($text);
    }
}
