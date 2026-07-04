USE almoqadas;

CREATE TABLE IF NOT EXISTS hero_slides (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    image      VARCHAR(255) NOT NULL,
    label      VARCHAR(120) NOT NULL DEFAULT '',
    sort_order INT          NOT NULL DEFAULT 0,
    active     TINYINT(1)   NOT NULL DEFAULT 1,
    created_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
