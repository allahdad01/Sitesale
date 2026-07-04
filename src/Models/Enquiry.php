<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Enquiry
{
    public static function create(array $data): bool
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare(
            "INSERT INTO enquiries (full_name, phone, email, service, message, ip_address, created_at)
             VALUES (:full_name, :phone, :email, :service, :message, :ip_address, NOW())"
        );

        return $stmt->execute([
            'full_name'  => $data['full_name'],
            'phone'      => $data['phone'],
            'email'      => $data['email'] ?? null,
            'service'    => $data['service'] ?? null,
            'message'    => $data['message'] ?? null,
            'ip_address' => $data['ip_address'] ?? null,
        ]);
    }

    public static function countByStatus(string $status): int
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM enquiries WHERE status = :status");
        $stmt->execute(['status' => $status]);
        return (int) $stmt->fetchColumn();
    }

    public static function recent(int $limit = 5): array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "SELECT id, full_name, phone, email, service, message, status, created_at
             FROM enquiries ORDER BY created_at DESC LIMIT :lim"
        );
        $stmt->bindValue('lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function countThisMonth(): int
    {
        $pdo = Database::connect();
        return (int) $pdo->query(
            "SELECT COUNT(*) FROM enquiries WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())"
        )->fetchColumn();
    }

    public static function monthlyCounts(int $months = 6): array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "SELECT DATE_FORMAT(created_at, '%b') AS label, MONTH(created_at) AS m, COUNT(*) AS value
             FROM enquiries
             WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL :months MONTH)
             GROUP BY YEAR(created_at), MONTH(created_at)
             ORDER BY MIN(created_at) ASC"
        );
        $stmt->bindValue('months', $months, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM enquiries WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public static function updateStatus(int $id, string $status): bool
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE enquiries SET status = :status WHERE id = :id");
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }
}
