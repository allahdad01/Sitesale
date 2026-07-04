CREATE TABLE IF NOT EXISTS `testimonials` (
    `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name`       VARCHAR(120)  NOT NULL,
    `position`   VARCHAR(120)  DEFAULT NULL,
    `content`    TEXT          NOT NULL,
    `rating`     TINYINT(1)    NOT NULL DEFAULT 5,
    `sort_order` INT           NOT NULL DEFAULT 0,
    `active`     TINYINT(1)    NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
