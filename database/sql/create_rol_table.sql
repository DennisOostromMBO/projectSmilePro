DROP PROCEDURE IF EXISTS create_rol_table;

CREATE PROCEDURE create_rol_table()
BEGIN
    CREATE TABLE IF NOT EXISTS rol (
        Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Naam VARCHAR(255) NOT NULL,
        IsActive BIT DEFAULT 1,
        Comments VARCHAR(255) NULL,
        Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        Updated_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;
END;