<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200818111733 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_elevage (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE temp');
        $this->addSql('ALTER TABLE agriculteur ADD type_elevage_id INT DEFAULT NULL, ADD op_boolean TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE agriculteur ADD CONSTRAINT FK_2366443B19E124A8 FOREIGN KEY (type_elevage_id) REFERENCES type_elevage (id)');
        $this->addSql('CREATE INDEX IDX_2366443B19E124A8 ON agriculteur (type_elevage_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agriculteur DROP FOREIGN KEY FK_2366443B19E124A8');
        $this->addSql('CREATE TABLE temp (id INT AUTO_INCREMENT NOT NULL, temporary VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE type_elevage');
        $this->addSql('DROP INDEX IDX_2366443B19E124A8 ON agriculteur');
        $this->addSql('ALTER TABLE agriculteur DROP type_elevage_id, DROP op_boolean');
    }
}
