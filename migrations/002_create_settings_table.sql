USE almoqadas;

CREATE TABLE IF NOT EXISTS settings (
    `key`   VARCHAR(100) PRIMARY KEY,
    `value` LONGTEXT DEFAULT NULL,
    `type`  VARCHAR(20) NOT NULL DEFAULT 'text' COMMENT 'text, textarea, color, image, number, boolean'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
