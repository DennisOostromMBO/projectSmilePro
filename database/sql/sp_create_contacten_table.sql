DROP PROCEDURE IF EXISTS create_contacten_table;
CREATE PROCEDURE create_contacten_table()
BEGIN
    CREATE TABLE IF NOT EXISTS contact (
        Id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
        PatientId BIGINT UNSIGNED NOT NULL,  
        Straatnaam VARCHAR(255) NOT NULL,  
        Huisnummer VARCHAR(10) NOT NULL,  
        Toevoeging VARCHAR(10) NULL, 
        Postcode VARCHAR(10) NOT NULL,  
        Plaats VARCHAR(255) NOT NULL,  
        VolledigAdres VARCHAR(512) AS (CONCAT(Straatnaam, ' ', Huisnummer,  IF(Toevoeging IS NOT NULL AND Toevoeging != '', CONCAT('-', Toevoeging), ''),  ', ', Postcode, ' ',   Plaats  )) STORED,
        Mobiel VARCHAR(20) NOT NULL,  
        Email VARCHAR(255) NOT NULL,  
        IsActief BIT DEFAULT 1,  
        Opmerking VARCHAR(255) NULL,  
        DatumAangemaakt TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
        DatumGewijzigd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
    ) ENGINE=InnoDB;
END;
 
        
