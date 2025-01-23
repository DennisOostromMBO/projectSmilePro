CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) NOT NULL PRIMARY KEY,
    user_id INT UNSIGNED NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload TEXT NOT NULL,
    last_activity INT UNSIGNED NOT NULL,
    CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;