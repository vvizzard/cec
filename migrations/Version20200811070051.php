<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200811070051 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE anciennete (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emplacement_pi (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localisation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE milieu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode_faire_valoir (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parcelle (id INT AUTO_INCREMENT NOT NULL, agriculteur_id INT NOT NULL, type_id INT DEFAULT NULL, type_sol_id INT DEFAULT NULL, mode_faire_valoir_id INT DEFAULT NULL, localisation_id INT DEFAULT NULL, milieu_id INT DEFAULT NULL, surface NUMERIC(6, 2) NOT NULL, irrigation TINYINT(1) DEFAULT NULL, compaction TINYINT(1) DEFAULT NULL, contre_saison TINYINT(1) DEFAULT NULL, zone_erodique TINYINT(1) DEFAULT NULL, longitude VARCHAR(100) DEFAULT NULL, latitude VARCHAR(100) DEFAULT NULL, observation VARCHAR(255) DEFAULT NULL, risque_innondation TINYINT(1) DEFAULT NULL, INDEX IDX_C56E2CF67EBB810E (agriculteur_id), INDEX IDX_C56E2CF6C54C8C93 (type_id), INDEX IDX_C56E2CF6EC3101F1 (type_sol_id), INDEX IDX_C56E2CF62CCD5D04 (mode_faire_valoir_id), INDEX IDX_C56E2CF6C68BE09C (localisation_id), INDEX IDX_C56E2CF6735F057F (milieu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_sol (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zc (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE parcelle ADD CONSTRAINT FK_C56E2CF67EBB810E FOREIGN KEY (agriculteur_id) REFERENCES agriculteur (id)');
        $this->addSql('ALTER TABLE parcelle ADD CONSTRAINT FK_C56E2CF6C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE parcelle ADD CONSTRAINT FK_C56E2CF6EC3101F1 FOREIGN KEY (type_sol_id) REFERENCES type_sol (id)');
        $this->addSql('ALTER TABLE parcelle ADD CONSTRAINT FK_C56E2CF62CCD5D04 FOREIGN KEY (mode_faire_valoir_id) REFERENCES mode_faire_valoir (id)');
        $this->addSql('ALTER TABLE parcelle ADD CONSTRAINT FK_C56E2CF6C68BE09C FOREIGN KEY (localisation_id) REFERENCES localisation (id)');
        $this->addSql('ALTER TABLE parcelle ADD CONSTRAINT FK_C56E2CF6735F057F FOREIGN KEY (milieu_id) REFERENCES milieu (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parcelle DROP FOREIGN KEY FK_C56E2CF6C68BE09C');
        $this->addSql('ALTER TABLE parcelle DROP FOREIGN KEY FK_C56E2CF6735F057F');
        $this->addSql('ALTER TABLE parcelle DROP FOREIGN KEY FK_C56E2CF62CCD5D04');
        $this->addSql('ALTER TABLE parcelle DROP FOREIGN KEY FK_C56E2CF6C54C8C93');
        $this->addSql('ALTER TABLE parcelle DROP FOREIGN KEY FK_C56E2CF6EC3101F1');
        $this->addSql('DROP TABLE anciennete');
        $this->addSql('DROP TABLE emplacement_pi');
        $this->addSql('DROP TABLE localisation');
        $this->addSql('DROP TABLE milieu');
        $this->addSql('DROP TABLE mode_faire_valoir');
        $this->addSql('DROP TABLE parcelle');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE type_sol');
        $this->addSql('DROP TABLE zc');
    }
}
