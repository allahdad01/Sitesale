<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Setting
{
    private static ?array $cache = null;

    public static function get(string $key, mixed $default = null): string|null
    {
        if (self::$cache === null) {
            self::loadAll();
        }

        return self::$cache[$key] ?? $default;
    }

    public static function all(): array
    {
        if (self::$cache === null) {
            self::loadAll();
        }

        return self::$cache;
    }

    public static function set(string $key, mixed $value, string $type = 'text'): void
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "INSERT INTO settings (`key`, `value`, `type`)
             VALUES (:key, :value, :type)
             ON DUPLICATE KEY UPDATE `value` = VALUES(`value`), `type` = VALUES(`type`)"
        );
        $stmt->execute([
            'key'   => $key,
            'value' => (string) $value,
            'type'  => $type,
        ]);

        if (self::$cache !== null) {
            self::$cache[$key] = (string) $value;
        }
    }

    public static function setMultiple(array $data): void
    {
        foreach ($data as $key => $item) {
            if (is_array($item)) {
                self::set($item['key'], $item['value'], $item['type'] ?? 'text');
            } else {
                self::set($key, $item);
            }
        }
    }

    public static function remove(string $key): void
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM settings WHERE `key` = :key");
        $stmt->execute(['key' => $key]);

        if (self::$cache !== null) {
            unset(self::$cache[$key]);
        }
    }

    private static function loadAll(): void
    {
        try {
            $pdo = Database::connect();
            $stmt = $pdo->query("SELECT `key`, `value` FROM settings");
            $rows = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
            self::$cache = $rows;
        } catch (\PDOException) {
            self::$cache = [];
        }
    }

    public static function getGroup(string $prefix): array
    {
        $all = self::all();
        $result = [];
        $prefixLen = strlen($prefix);
        foreach ($all as $key => $value) {
            if (str_starts_with($key, $prefix)) {
                $result[substr($key, $prefixLen)] = $value;
            }
        }
        return $result;
    }

    public static function flushCache(): void
    {
        self::$cache = null;
    }
}
