<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200806162044 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agriculteur ADD typologie_id INT DEFAULT NULL, ADD bvpi_id INT DEFAULT NULL, ADD zone_technicien_id INT DEFAULT NULL, ADD op_id INT DEFAULT NULL, ADD ce_id INT DEFAULT NULL, ADD elevage_id INT DEFAULT NULL, ADD culture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agriculteur ADD CONSTRAINT FK_2366443B42F4634A FOREIGN KEY (typologie_id) REFERENCES typologie (id)');
        $this->addSql('ALTER TABLE agriculteur ADD CONSTRAINT FK_2366443B7AC2280A FOREIGN KEY (bvpi_id) REFERENCES bvpi (id)');
        $this->addSql('ALTER TABLE agriculteur ADD CONSTRAINT FK_2366443BC4531AA FOREIGN KEY (zone_technicien_id) REFERENCES zone_technicien (id)');
        $this->addSql('ALTER TABLE agriculteur ADD CONSTRAINT FK_2366443B2F7FAB3F FOREIGN KEY (op_id) REFERENCES op (id)');
        $this->addSql('ALTER TABLE agriculteur ADD CONSTRAINT FK_2366443B8D48E193 FOREIGN KEY (ce_id) REFERENCES ce (id)');
        $this->addSql('ALTER TABLE agriculteur ADD CONSTRAINT FK_2366443B4E2F28D FOREIGN KEY (elevage_id) REFERENCES elevage (id)');
        $this->addSql('ALTER TABLE agriculteur ADD CONSTRAINT FK_2366443BB108249D FOREIGN KEY (culture_id) REFERENCES culture (id)');
        $this->addSql('CREATE INDEX IDX_2366443B42F4634A ON agriculteur (typologie_id)');
        $this->addSql('CREATE INDEX IDX_2366443B7AC2280A ON agriculteur (bvpi_id)');
        $this->addSql('CREATE INDEX IDX_2366443BC4531AA ON agriculteur (zone_technicien_id)');
        $this->addSql('CREATE INDEX IDX_2366443B2F7FAB3F ON agriculteur (op_id)');
        $this->addSql('CREATE INDEX IDX_2366443B8D48E193 ON agriculteur (ce_id)');
        $this->addSql('CREATE INDEX IDX_2366443B4E2F28D ON agriculteur (elevage_id)');
        $this->addSql('CREATE INDEX IDX_2366443BB108249D ON agriculteur (culture_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agriculteur DROP FOREIGN KEY FK_2366443B42F4634A');
        $this->addSql('ALTER TABLE agriculteur DROP FOREIGN KEY FK_2366443B7AC2280A');
        $this->addSql('ALTER TABLE agriculteur DROP FOREIGN KEY FK_2366443BC4531AA');
        $this->addSql('ALTER TABLE agriculteur DROP FOREIGN KEY FK_2366443B2F7FAB3F');
        $this->addSql('ALTER TABLE agriculteur DROP FOREIGN KEY FK_2366443B8D48E193');
        $this->addSql('ALTER TABLE agriculteur DROP FOREIGN KEY FK_2366443B4E2F28D');
        $this->addSql('ALTER TABLE agriculteur DROP FOREIGN KEY FK_2366443BB108249D');
        $this->addSql('DROP INDEX IDX_2366443B42F4634A ON agriculteur');
        $this->addSql('DROP INDEX IDX_2366443B7AC2280A ON agriculteur');
        $this->addSql('DROP INDEX IDX_2366443BC4531AA ON agriculteur');
        $this->addSql('DROP INDEX IDX_2366443B2F7FAB3F ON agriculteur');
        $this->addSql('DROP INDEX IDX_2366443B8D48E193 ON agriculteur');
        $this->addSql('DROP INDEX IDX_2366443B4E2F28D ON agriculteur');
        $this->addSql('DROP INDEX IDX_2366443BB108249D ON agriculteur');
        $this->addSql('ALTER TABLE agriculteur DROP typologie_id, DROP bvpi_id, DROP zone_technicien_id, DROP op_id, DROP ce_id, DROP elevage_id, DROP culture_id');
    }
}
