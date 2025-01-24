CREATE TABLE IF NOT EXISTS factuur(
    id int UNSIGNED NOT NULL AUTO_INCREMENT,
    persoon_id int UNSIGNED NOT NULL,
    beschrijving varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    vervaldatum date NOT NULL,
    btw decimal(5,2) NOT NULL,
    totaal_bedrag decimal(10,2) NOT NULL,
    betaald BOOLEAN NOT NULL DEFAULT 0,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY factuur_persoon_id_foreign (persoon_id)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE factuur
    ADD CONSTRAINT factuur_persoon_id_foreign FOREIGN KEY (persoon_id) REFERENCES persoon (id) ON DELETE CASCADE;
COMMIT;


