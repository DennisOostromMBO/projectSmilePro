 CREATE TABLE IF NOT EXISTS gebruiker (
        Id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        PersoonId INT UNSIGNED NOT NULL,
        name VARCHAR(255) NOT NULL,
        Email VARCHAR(255) NOT NULL, 
        password VARCHAR(255) NOT NULL, -- Gebruik de standaard 'password' kolom
        remember_token VARCHAR(100) DEFAULT NULL,
        Isingelogd BIT DEFAULT 0 NOT NULL,
        Ingelogd TIMESTAMP(6) NOT NULL default CURRENT_TIMESTAMP(6),
        Uitgelogd TIMESTAMP(6) NOT NULL default CURRENT_TIMESTAMP(6),
        IsActive BIT DEFAULT 1 NOT NULL,
        Comments VARCHAR(255) NULL,
        created_at TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
        updated_at TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
        FOREIGN KEY (PersoonId) REFERENCES persoon(Id) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB;
