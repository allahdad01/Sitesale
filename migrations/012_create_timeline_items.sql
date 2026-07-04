USE almoqadas;

CREATE TABLE IF NOT EXISTS timeline_items (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    year       VARCHAR(20)   NOT NULL DEFAULT '',
    title      VARCHAR(255)  NOT NULL DEFAULT '',
    text       TEXT          DEFAULT NULL,
    sort_order INT           NOT NULL DEFAULT 0,
    active     TINYINT(1)    NOT NULL DEFAULT 1,
    created_at TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
