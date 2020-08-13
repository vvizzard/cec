<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200810131958 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipement_agricole (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nbr_culture_agriculteur (id INT AUTO_INCREMENT NOT NULL, culture_id INT NOT NULL, agriculteur_id INT NOT NULL, nbr INT NOT NULL, INDEX IDX_B23F1B4DB108249D (culture_id), INDEX IDX_B23F1B4D7EBB810E (agriculteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nbr_equipement_agricole_agriculteur (id INT AUTO_INCREMENT NOT NULL, equipement_agricole_id INT NOT NULL, agriculteur_id INT NOT NULL, nbr INT NOT NULL, INDEX IDX_32C0AD1C2C2FC99 (equipement_agricole_id), INDEX IDX_32C0AD1C7EBB810E (agriculteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nbr_culture_agriculteur ADD CONSTRAINT FK_B23F1B4DB108249D FOREIGN KEY (culture_id) REFERENCES culture (id)');
        $this->addSql('ALTER TABLE nbr_culture_agriculteur ADD CONSTRAINT FK_B23F1B4D7EBB810E FOREIGN KEY (agriculteur_id) REFERENCES agriculteur (id)');
        $this->addSql('ALTER TABLE nbr_equipement_agricole_agriculteur ADD CONSTRAINT FK_32C0AD1C2C2FC99 FOREIGN KEY (equipement_agricole_id) REFERENCES equipement_agricole (id)');
        $this->addSql('ALTER TABLE nbr_equipement_agricole_agriculteur ADD CONSTRAINT FK_32C0AD1C7EBB810E FOREIGN KEY (agriculteur_id) REFERENCES agriculteur (id)');
        $this->addSql('ALTER TABLE agriculteur DROP nbr_boeuf_trait, DROP nbr_zebu, DROP nbr_vache_laitiere, DROP nbr_pulverisateur, DROP nbr_brouette, DROP nbr_arrosoir, DROP nbr_herse, DROP nbr_bicyclette, DROP nbr_angady');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nbr_equipement_agricole_agriculteur DROP FOREIGN KEY FK_32C0AD1C2C2FC99');
        $this->addSql('DROP TABLE equipement_agricole');
        $this->addSql('DROP TABLE nbr_culture_agriculteur');
        $this->addSql('DROP TABLE nbr_equipement_agricole_agriculteur');
        $this->addSql('ALTER TABLE agriculteur ADD nbr_boeuf_trait SMALLINT DEFAULT NULL, ADD nbr_zebu INT DEFAULT NULL, ADD nbr_vache_laitiere INT DEFAULT NULL, ADD nbr_pulverisateur INT DEFAULT NULL, ADD nbr_brouette INT DEFAULT NULL, ADD nbr_arrosoir INT DEFAULT NULL, ADD nbr_herse INT DEFAULT NULL, ADD nbr_bicyclette INT DEFAULT NULL, ADD nbr_angady INT DEFAULT NULL');
    }
}
