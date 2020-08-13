<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200806152857 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agriculteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(50) NOT NULL, genre SMALLINT NOT NULL, age SMALLINT NOT NULL, statut_famille VARCHAR(20) NOT NULL, anciennete SMALLINT NOT NULL, lot SMALLINT NOT NULL, region VARCHAR(100) NOT NULL, sous_region VARCHAR(100) DEFAULT NULL, district VARCHAR(100) NOT NULL, terroir VARCHAR(100) DEFAULT NULL, commune VARCHAR(100) NOT NULL, village VARCHAR(100) DEFAULT NULL, surface_totale_exploitee NUMERIC(6, 2) DEFAULT NULL, surface_totale_riziere NUMERIC(6, 2) DEFAULT NULL, surface_parcelle_louee NUMERIC(6, 2) DEFAULT NULL, surface_parcelle_en_location NUMERIC(6, 2) DEFAULT NULL, nbr_menage SMALLINT DEFAULT NULL, nbr_actif SMALLINT DEFAULT NULL, nbr_mois_autosuffisance_riz SMALLINT DEFAULT NULL, acces_riziere VARCHAR(100) DEFAULT NULL, nbr_boeuf_trait SMALLINT DEFAULT NULL, nbr_zebu INT DEFAULT NULL, nbr_vache_laitiere INT DEFAULT NULL, equipement_agricole TINYINT(1) DEFAULT NULL, nbr_pulverisateur INT DEFAULT NULL, nbr_brouette INT DEFAULT NULL, nbr_arrosoir INT DEFAULT NULL, nbr_herse INT DEFAULT NULL, nbr_bicyclette INT DEFAULT NULL, nbr_angady INT DEFAULT NULL, pratique_activite_agricole TINYINT(1) DEFAULT NULL, pratique_elevage_rente TINYINT(1) DEFAULT NULL, pratique_activite_non_agricole TINYINT(1) DEFAULT NULL, pratique_peche TINYINT(1) DEFAULT NULL, autre_programme TINYINT(1) DEFAULT NULL, nbr_mois_soudure SMALLINT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bvpi (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, numero VARCHAR(10) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ce (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE culture (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, rente TINYINT(1) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE elevage (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, rente TINYINT(1) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nbr_elevage_agriculteur (id INT AUTO_INCREMENT NOT NULL, agriculteur_id INT NOT NULL, elevage_id INT NOT NULL, nbr INT NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, INDEX IDX_335A5D387EBB810E (agriculteur_id), INDEX IDX_335A5D384E2F28D (elevage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE op (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE typologie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone_technicien (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nbr_elevage_agriculteur ADD CONSTRAINT FK_335A5D387EBB810E FOREIGN KEY (agriculteur_id) REFERENCES agriculteur (id)');
        $this->addSql('ALTER TABLE nbr_elevage_agriculteur ADD CONSTRAINT FK_335A5D384E2F28D FOREIGN KEY (elevage_id) REFERENCES elevage (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nbr_elevage_agriculteur DROP FOREIGN KEY FK_335A5D387EBB810E');
        $this->addSql('ALTER TABLE nbr_elevage_agriculteur DROP FOREIGN KEY FK_335A5D384E2F28D');
        $this->addSql('DROP TABLE agriculteur');
        $this->addSql('DROP TABLE bvpi');
        $this->addSql('DROP TABLE ce');
        $this->addSql('DROP TABLE culture');
        $this->addSql('DROP TABLE elevage');
        $this->addSql('DROP TABLE nbr_elevage_agriculteur');
        $this->addSql('DROP TABLE op');
        $this->addSql('DROP TABLE typologie');
        $this->addSql('DROP TABLE zone_technicien');
    }
}
