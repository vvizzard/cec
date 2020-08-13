<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200811102655 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parcelle ADD zc_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parcelle ADD CONSTRAINT FK_C56E2CF6C5D34BBC FOREIGN KEY (zc_id) REFERENCES zc (id)');
        $this->addSql('CREATE INDEX IDX_C56E2CF6C5D34BBC ON parcelle (zc_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parcelle DROP FOREIGN KEY FK_C56E2CF6C5D34BBC');
        $this->addSql('DROP INDEX IDX_C56E2CF6C5D34BBC ON parcelle');
        $this->addSql('ALTER TABLE parcelle DROP zc_id');
    }
}
