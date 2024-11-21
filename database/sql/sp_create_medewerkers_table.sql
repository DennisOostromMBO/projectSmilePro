DROP PROCEDURE IF EXISTS create_medewerker_table;

CREATE PROCEDURE create_medewerker_table()
BEGIN
    CREATE TABLE IF NOT EXISTS medewerkers (
        Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        PersoonId INT UNSIGNED NOT NULL,
        Nummer VARCHAR(255) NOT NULL,
        Medewerkertype VARCHAR(255) NOT NULL,
        Specialisatie VARCHAR(255) NOT NULL,
        Beschikbaarheid VARCHAR(255) NOT NULL,
        IsActive BIT DEFAULT 1,
        Comments VARCHAR(255) NULL,
        CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        -- FOREIGN KEY (PersoonId) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB;
END;

-- DROP PROCEDURE IF EXISTS create_medewerker_table;

-- CREATE PROCEDURE IF NOT EXISTS create_medewerker_table()
-- BEGIN
--     CREATE TABLE IF NOT EXISTS medewerkers (
--         Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY
--         ,PersoonId INT UNSIGNED NOT NULL
--         ,Nummer VARCHAR(255) NOT NULL
--         ,Medewerkertype VARCHAR(255) NOT NULL
--         ,Specialisatie VARCHAR(255) NOT NULL
--         ,Beschikbaarheid VARCHAR(255) NOT NULL
--         ,IsActive BIT DEFAULT 1
--         ,Comments VARCHAR(255) NULL
--         ,CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
--         ,UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
--         ,FOREIGN KEY (PersoonId) REFERENCES users(id)
--     ) ENGINE=InnoDB;
-- END;

