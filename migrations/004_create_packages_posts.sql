USE almoqadas;

CREATE TABLE IF NOT EXISTS packages (
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title        VARCHAR(200) NOT NULL,
    slug         VARCHAR(200) NOT NULL UNIQUE,
    description  TEXT         NOT NULL,
    image        VARCHAR(255) DEFAULT NULL,
    price        DECIMAL(12,2) NOT NULL DEFAULT 0,
    duration_days INT        NOT NULL DEFAULT 1,
    max_people   INT         NOT NULL DEFAULT 1,
    category     VARCHAR(60) NOT NULL DEFAULT 'tour' COMMENT 'hajj, umrah, tour, flight, visa, hotel',
    destination  VARCHAR(120) DEFAULT NULL,
    featured     TINYINT(1)  NOT NULL DEFAULT 0,
    active       TINYINT(1)  NOT NULL DEFAULT 1,
    created_at   TIMESTAMP   DEFAULT CURRENT_TIMESTAMP,
    updated_at   TIMESTAMP   DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS posts (
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title        VARCHAR(200) NOT NULL,
    slug         VARCHAR(200) NOT NULL UNIQUE,
    excerpt      TEXT         DEFAULT NULL,
    content      LONGTEXT     DEFAULT NULL,
    image        VARCHAR(255) DEFAULT NULL,
    author       VARCHAR(120) DEFAULT NULL,
    category     VARCHAR(60)  DEFAULT NULL,
    published_at TIMESTAMP    NULL DEFAULT NULL,
    active       TINYINT(1)   NOT NULL DEFAULT 1,
    created_at   TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    updated_at   TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
