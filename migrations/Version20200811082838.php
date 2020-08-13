<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200811082838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parcelle ADD anciennete_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parcelle ADD CONSTRAINT FK_C56E2CF63039A7E3 FOREIGN KEY (anciennete_id) REFERENCES anciennete (id)');
        $this->addSql('CREATE INDEX IDX_C56E2CF63039A7E3 ON parcelle (anciennete_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parcelle DROP FOREIGN KEY FK_C56E2CF63039A7E3');
        $this->addSql('DROP INDEX IDX_C56E2CF63039A7E3 ON parcelle');
        $this->addSql('ALTER TABLE parcelle DROP anciennete_id');
    }
}
