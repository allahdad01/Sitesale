<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Booking
{
    public static function create(array $data): int
    {
        $pdo = Database::connect();

        $ref = self::generateRef();

        $stmt = $pdo->prepare(
            "INSERT INTO bookings (booking_ref, package_id, package_title, full_name, phone, email, travel_date, group_size, service, message, ip_address, created_at)
             VALUES (:booking_ref, :package_id, :package_title, :full_name, :phone, :email, :travel_date, :group_size, :service, :message, :ip_address, NOW())"
        );

        $stmt->execute([
            'booking_ref'   => $ref,
            'package_id'    => $data['package_id'] ?? null,
            'package_title' => $data['package_title'] ?? null,
            'full_name'     => $data['full_name'],
            'phone'         => $data['phone'],
            'email'         => $data['email'] ?? null,
            'travel_date'   => $data['travel_date'] ?? null,
            'group_size'    => $data['group_size'] ?? 1,
            'service'       => $data['service'] ?? null,
            'message'       => $data['message'] ?? null,
            'ip_address'    => $data['ip_address'] ?? null,
        ]);

        return (int) $pdo->lastInsertId();
    }

    public static function find(int $id): ?array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM bookings WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public static function findByRef(string $ref): ?array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM bookings WHERE booking_ref = :ref");
        $stmt->execute(['ref' => $ref]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public static function all(int $limit = 50, string $status = ''): array
    {
        $pdo = Database::connect();
        $sql = "SELECT * FROM bookings";
        $params = [];

        if ($status) {
            $sql .= " WHERE status = :status";
            $params['status'] = $status;
        }

        $sql .= " ORDER BY created_at DESC LIMIT :lim";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('lim', $limit, PDO::PARAM_INT);

        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function updateStatus(int $id, string $status): bool
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE bookings SET status = :status WHERE id = :id");
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }

    public static function updateNotes(int $id, string $notes): bool
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE bookings SET admin_notes = :notes WHERE id = :id");
        return $stmt->execute(['notes' => $notes, 'id' => $id]);
    }

    public static function countByStatus(string $status): int
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM bookings WHERE status = :status");
        $stmt->execute(['status' => $status]);
        return (int) $stmt->fetchColumn();
    }

    public static function countThisMonth(): int
    {
        $pdo = Database::connect();
        return (int) $pdo->query(
            "SELECT COUNT(*) FROM bookings WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())"
        )->fetchColumn();
    }

    public static function monthlyCounts(int $months = 6): array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "SELECT DATE_FORMAT(created_at, '%b') AS label, MONTH(created_at) AS m, COUNT(*) AS value
             FROM bookings
             WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL :months MONTH)
             GROUP BY YEAR(created_at), MONTH(created_at)
             ORDER BY MIN(created_at) ASC"
        );
        $stmt->bindValue('months', $months, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    private static function generateRef(): string
    {
        $pdo = Database::connect();
        $prefix = 'BK-' . date('ym');
        $max = 0;

        $stmt = $pdo->prepare(
            "SELECT MAX(CAST(SUBSTRING(booking_ref, 9) AS UNSIGNED)) FROM bookings WHERE booking_ref LIKE :prefix"
        );
        $stmt->execute(['prefix' => $prefix . '%']);
        $max = (int) $stmt->fetchColumn();

        return $prefix . '-' . str_pad($max + 1, 4, '0', STR_PAD_LEFT);
    }
}
