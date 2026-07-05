<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Faq
{
    public static function all(): array
    {
        $pdo = Database::connect();
        return $pdo->query("SELECT * FROM faqs WHERE active = 1 ORDER BY sort_order ASC, id ASC")->fetchAll();
    }

    public static function allAdmin(): array
    {
        $pdo = Database::connect();
        return $pdo->query("SELECT * FROM faqs ORDER BY sort_order ASC, id ASC")->fetchAll();
    }

    public static function find(int $id): array|false
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM faqs WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function create(array $data): int
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "INSERT INTO faqs (question, question_en, question_ps, question_fa, answer, answer_en, answer_ps, answer_fa, sort_order, active)
             VALUES (:question, :question_en, :question_ps, :question_fa, :answer, :answer_en, :answer_ps, :answer_fa, :sort_order, :active)"
        );
        $stmt->execute([
            'question'     => $data['question'] ?? '',
            'question_en'  => $data['question_en'] ?? $data['question'] ?? '',
            'question_ps'  => $data['question_ps'] ?? '',
            'question_fa'  => $data['question_fa'] ?? '',
            'answer'       => $data['answer'] ?? '',
            'answer_en'    => $data['answer_en'] ?? $data['answer'] ?? '',
            'answer_ps'    => $data['answer_ps'] ?? '',
            'answer_fa'    => $data['answer_fa'] ?? '',
            'sort_order' => (int) ($data['sort_order'] ?? 0),
            'active'     => (int) ($data['active'] ?? 1),
        ]);
        return (int) $pdo->lastInsertId();
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::connect();
        return $pdo->prepare("DELETE FROM faqs WHERE id = :id")->execute(['id' => $id]);
    }

    public static function maxSortOrder(): int
    {
        $pdo = Database::connect();
        return (int) $pdo->query("SELECT COALESCE(MAX(sort_order), -1) FROM faqs")->fetchColumn();
    }
}
