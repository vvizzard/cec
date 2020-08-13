<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200812065751 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agriculteur ADD village_id INT DEFAULT NULL, ADD terroir_id INT DEFAULT NULL, ADD sous_region_id INT DEFAULT NULL, ADD region_id INT DEFAULT NULL, ADD commune_id INT DEFAULT NULL, ADD anciennete_id INT DEFAULT NULL, DROP anciennete, DROP region, DROP sous_region, DROP terroir, DROP commune, DROP village');
        $this->addSql('ALTER TABLE agriculteur ADD CONSTRAINT FK_2366443B5E0D5582 FOREIGN KEY (village_id) REFERENCES village (id)');
        $this->addSql('ALTER TABLE agriculteur ADD CONSTRAINT FK_2366443BAAE80216 FOREIGN KEY (terroir_id) REFERENCES terroir (id)');
        $this->addSql('ALTER TABLE agriculteur ADD CONSTRAINT FK_2366443B832FEA1A FOREIGN KEY (sous_region_id) REFERENCES sous_region (id)');
        $this->addSql('ALTER TABLE agriculteur ADD CONSTRAINT FK_2366443B98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE agriculteur ADD CONSTRAINT FK_2366443B131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE agriculteur ADD CONSTRAINT FK_2366443B3039A7E3 FOREIGN KEY (anciennete_id) REFERENCES anciennete_agriculteur (id)');
        $this->addSql('CREATE INDEX IDX_2366443B5E0D5582 ON agriculteur (village_id)');
        $this->addSql('CREATE INDEX IDX_2366443BAAE80216 ON agriculteur (terroir_id)');
        $this->addSql('CREATE INDEX IDX_2366443B832FEA1A ON agriculteur (sous_region_id)');
        $this->addSql('CREATE INDEX IDX_2366443B98260155 ON agriculteur (region_id)');
        $this->addSql('CREATE INDEX IDX_2366443B131A4F72 ON agriculteur (commune_id)');
        $this->addSql('CREATE INDEX IDX_2366443B3039A7E3 ON agriculteur (anciennete_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agriculteur DROP FOREIGN KEY FK_2366443B5E0D5582');
        $this->addSql('ALTER TABLE agriculteur DROP FOREIGN KEY FK_2366443BAAE80216');
        $this->addSql('ALTER TABLE agriculteur DROP FOREIGN KEY FK_2366443B832FEA1A');
        $this->addSql('ALTER TABLE agriculteur DROP FOREIGN KEY FK_2366443B98260155');
        $this->addSql('ALTER TABLE agriculteur DROP FOREIGN KEY FK_2366443B131A4F72');
        $this->addSql('ALTER TABLE agriculteur DROP FOREIGN KEY FK_2366443B3039A7E3');
        $this->addSql('DROP INDEX IDX_2366443B5E0D5582 ON agriculteur');
        $this->addSql('DROP INDEX IDX_2366443BAAE80216 ON agriculteur');
        $this->addSql('DROP INDEX IDX_2366443B832FEA1A ON agriculteur');
        $this->addSql('DROP INDEX IDX_2366443B98260155 ON agriculteur');
        $this->addSql('DROP INDEX IDX_2366443B131A4F72 ON agriculteur');
        $this->addSql('DROP INDEX IDX_2366443B3039A7E3 ON agriculteur');
        $this->addSql('ALTER TABLE agriculteur ADD anciennete SMALLINT NOT NULL, ADD region VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD sous_region VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD terroir VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD commune VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD village VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP village_id, DROP terroir_id, DROP sous_region_id, DROP region_id, DROP commune_id, DROP anciennete_id');
    }
}
