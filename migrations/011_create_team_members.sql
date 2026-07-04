USE almoqadas;

CREATE TABLE IF NOT EXISTS team_members (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(120)  NOT NULL,
    role       VARCHAR(120)  NOT NULL DEFAULT '',
    bio        TEXT          DEFAULT NULL,
    image      VARCHAR(255)  NOT NULL DEFAULT '',
    type       ENUM('lead','member') NOT NULL DEFAULT 'member',
    sort_order INT           NOT NULL DEFAULT 0,
    active     TINYINT(1)    NOT NULL DEFAULT 1,
    created_at TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
