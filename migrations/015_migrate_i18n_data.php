<?php
/**
 * Data migration: copy existing content to _en locale columns.
 * Run once after 014_add_i18n_columns.sql.
 */
$env = parse_ini_file(__DIR__ . '/../.env');
$host = $env['DB_HOST'] ?? '127.0.0.1';
$port = $env['DB_PORT'] ?? '3306';
$name = $env['DB_NAME'] ?? 'almoqadas';
$user = $env['DB_USER'] ?? 'root';
$pass = $env['DB_PASS'] ?? '';

$pdo = new PDO(
    "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4",
    $user,
    $pass,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

$migrations = [
    ["UPDATE packages SET title_en = title, description_en = description, destination_en = destination WHERE title_en = ''", 'packages'],
    ["UPDATE posts SET title_en = title, excerpt_en = excerpt, content_en = content, author_en = author WHERE title_en = ''", 'posts'],
    ["UPDATE services SET title_en = title, tag_en = tag, description_en = description WHERE title_en = ''", 'services'],
    ["UPDATE faqs SET question_en = question, answer_en = answer WHERE question_en = ''", 'faqs'],
    ["UPDATE hero_slides SET label_en = label WHERE label_en = ''", 'hero_slides'],
    ["UPDATE awards SET label_en = label WHERE label_en = ''", 'awards'],
    ["UPDATE testimonials SET name_en = name, position_en = position, content_en = content WHERE name_en = ''", 'testimonials'],
    ["UPDATE team_members SET name_en = name, role_en = role, bio_en = bio WHERE name_en = ''", 'team_members'],
    ["UPDATE timeline_items SET year_en = year, title_en = title, text_en = text WHERE year_en = ''", 'timeline_items'],
    ["UPDATE page_sections SET label_en = label, content_en = content WHERE label_en = ''", 'page_sections'],
];

foreach ($migrations as [$sql, $table]) {
    $count = $pdo->exec($sql);
    echo "Migrated {$count} rows in {$table}\n";
}

echo "Done.\n";
