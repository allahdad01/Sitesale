USE almoqadas;

CREATE TABLE IF NOT EXISTS services (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title      VARCHAR(120) NOT NULL,
    tag        VARCHAR(60)  NOT NULL DEFAULT '',
    description TEXT        NOT NULL DEFAULT '',
    image      VARCHAR(255) NOT NULL DEFAULT '',
    link       VARCHAR(255) NOT NULL DEFAULT '',
    sort_order INT          NOT NULL DEFAULT 0,
    active     TINYINT(1)   NOT NULL DEFAULT 1,
    created_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
