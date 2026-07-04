<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;

    public static function connect(): PDO
    {
        if (self::$instance !== null) {
            return self::$instance;
        }

        $config = require __DIR__ . '/../../config/database.php';

        $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";

        self::$instance = new PDO($dsn, $config['username'], $config['password'], $config['options']);

        return self::$instance;
    }

    public static function disconnect(): void
    {
        self::$instance = null;
    }
}
