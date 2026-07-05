CREATE TABLE IF NOT EXISTS `faqs` (
    `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `question`   VARCHAR(255)  NOT NULL,
    `answer`     TEXT          NOT NULL,
    `sort_order` INT           NOT NULL DEFAULT 0,
    `active`     TINYINT(1)    NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;