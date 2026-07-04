CREATE DATABASE IF NOT EXISTS almoqadas
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE almoqadas;

CREATE TABLE IF NOT EXISTS admin_users (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username    VARCHAR(60)  NOT NULL UNIQUE,
    email       VARCHAR(120) NOT NULL UNIQUE,
    password    VARCHAR(255) NOT NULL COMMENT 'bcrypt hash',
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS enquiries (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name   VARCHAR(120) NOT NULL,
    phone       VARCHAR(30)  NOT NULL,
    email       VARCHAR(120) DEFAULT NULL,
    service     VARCHAR(60)  DEFAULT NULL,
    message     TEXT         DEFAULT NULL,
    ip_address  VARCHAR(45)  DEFAULT NULL,
    status      ENUM('pending','read','replied') NOT NULL DEFAULT 'pending',
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
