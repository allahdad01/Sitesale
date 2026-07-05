<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Post
{
    public static function all(int $limit = 0): array
    {
        $pdo = Database::connect();
        $sql = "SELECT * FROM posts WHERE active = 1 AND (published_at IS NULL OR published_at <= NOW()) ORDER BY featured DESC, published_at DESC";
        if ($limit > 0) $sql .= " LIMIT " . (int) $limit;
        return $pdo->query($sql)->fetchAll();
    }

    public static function featured(int $limit = 3): array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "SELECT * FROM posts WHERE active = 1 AND featured = 1 AND (published_at IS NULL OR published_at <= NOW()) ORDER BY published_at DESC LIMIT :lim"
        );
        $stmt->bindValue('lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function findBySlug(string $slug): array|false
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "SELECT * FROM posts WHERE slug = :slug AND active = 1 AND (published_at IS NULL OR published_at <= NOW()) LIMIT 1"
        );
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetch();
    }

    public static function find(int $id): array|false
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function create(array $data): int
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "INSERT INTO posts (title, title_en, title_ps, title_fa, slug, excerpt, excerpt_en, excerpt_ps, excerpt_fa, content, content_en, content_ps, content_fa, image, author, author_en, author_ps, author_fa, category, featured, published_at, active)
             VALUES (:title, :title_en, :title_ps, :title_fa, :slug, :excerpt, :excerpt_en, :excerpt_ps, :excerpt_fa, :content, :content_en, :content_ps, :content_fa, :image, :author, :author_en, :author_ps, :author_fa, :category, :featured, :published_at, :active)"
        );
        $stmt->execute([
            'title'        => $data['title'],
            'title_en'     => $data['title_en'] ?? $data['title'],
            'title_ps'     => $data['title_ps'] ?? '',
            'title_fa'     => $data['title_fa'] ?? '',
            'slug'         => $data['slug'] ?? self::slugify($data['title']),
            'excerpt'      => $data['excerpt'] ?? '',
            'excerpt_en'   => $data['excerpt_en'] ?? $data['excerpt'] ?? '',
            'excerpt_ps'   => $data['excerpt_ps'] ?? '',
            'excerpt_fa'   => $data['excerpt_fa'] ?? '',
            'content'      => $data['content'] ?? '',
            'content_en'   => $data['content_en'] ?? $data['content'] ?? '',
            'content_ps'   => $data['content_ps'] ?? '',
            'content_fa'   => $data['content_fa'] ?? '',
            'image'        => $data['image'] ?? null,
            'author'       => $data['author'] ?? null,
            'author_en'    => $data['author_en'] ?? $data['author'] ?? '',
            'author_ps'    => $data['author_ps'] ?? '',
            'author_fa'    => $data['author_fa'] ?? '',
            'category'     => $data['category'] ?? null,
            'featured'     => $data['featured'] ?? 0,
            'published_at' => $data['published_at'] ?? date('Y-m-d H:i:s'),
            'active'       => $data['active'] ?? 1,
        ]);
        return (int) $pdo->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $pdo = Database::connect();
        $fields = [];
        $params = ['id' => $id];
        $cols = ['title', 'title_en', 'title_ps', 'title_fa', 'slug', 'excerpt', 'excerpt_en', 'excerpt_ps', 'excerpt_fa', 'content', 'content_en', 'content_ps', 'content_fa', 'image', 'author', 'author_en', 'author_ps', 'author_fa', 'category', 'featured', 'published_at', 'active'];

        foreach ($cols as $c) {
            if (array_key_exists($c, $data)) {
                $fields[] = "`$c` = :$c";
                $params[$c] = $data[$c];
            }
        }

        if (empty($fields)) return false;
        $sql = "UPDATE posts SET " . implode(', ', $fields) . " WHERE id = :id";
        return $pdo->prepare($sql)->execute($params);
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::connect();
        return $pdo->prepare("DELETE FROM posts WHERE id = :id")->execute(['id' => $id]);
    }

    public static function toggleFeatured(int $id): bool
    {
        $post = self::find($id);
        if (!$post) return false;
        return self::update($id, ['featured' => $post['featured'] ? 0 : 1]);
    }

    public static function allAdmin(): array
    {
        $pdo = Database::connect();
        return $pdo->query("SELECT * FROM posts ORDER BY created_at DESC")->fetchAll();
    }

    public static function slugify(string $text): string
    {
        $text = preg_replace('/[^a-zA-Z0-9\s-]/', '', $text);
        $text = preg_replace('/[\s-]+/', '-', trim($text));
        return strtolower($text);
    }
}
