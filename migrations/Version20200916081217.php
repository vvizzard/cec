<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200916081217 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE culture_mere DROP FOREIGN KEY FK_1744C0B24433ED66');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B24433ED66 FOREIGN KEY (parcelle_id) REFERENCES parcelle (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE culture_mere DROP FOREIGN KEY FK_1744C0B24433ED66');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B24433ED66 FOREIGN KEY (parcelle_id) REFERENCES parcelle (id)');
    }
}
