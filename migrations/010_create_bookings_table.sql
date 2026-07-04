USE almoqadas;

CREATE TABLE IF NOT EXISTS bookings (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    booking_ref   VARCHAR(20)  NOT NULL UNIQUE,
    package_id    INT UNSIGNED DEFAULT NULL,
    package_title VARCHAR(200) DEFAULT NULL,
    full_name     VARCHAR(120) NOT NULL,
    phone         VARCHAR(30)  NOT NULL,
    email         VARCHAR(120) DEFAULT NULL,
    travel_date   DATE         DEFAULT NULL,
    group_size    INT          NOT NULL DEFAULT 1,
    service       VARCHAR(60)  DEFAULT NULL,
    message       TEXT         DEFAULT NULL,
    admin_notes   TEXT         DEFAULT NULL,
    status        ENUM('pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending',
    ip_address    VARCHAR(45)  DEFAULT NULL,
    created_at    TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_booking_ref (booking_ref)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
