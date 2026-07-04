USE almoqadas;

CREATE TABLE IF NOT EXISTS page_sections (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    page        VARCHAR(60)  NOT NULL DEFAULT 'home',
    section_key VARCHAR(60)  NOT NULL,
    label       VARCHAR(200) NOT NULL DEFAULT '',
    type        VARCHAR(60)  NOT NULL DEFAULT 'builtin' COMMENT 'builtin or custom_html',
    content     LONGTEXT     DEFAULT NULL COMMENT 'HTML content for custom sections',
    sort_order  INT          NOT NULL DEFAULT 0,
    active      TINYINT(1)   NOT NULL DEFAULT 1,
    created_at  TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
