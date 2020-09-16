<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200916081300 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE culture_fille DROP FOREIGN KEY FK_30DE57A01AD0BD9E');
        $this->addSql('ALTER TABLE culture_fille ADD CONSTRAINT FK_30DE57A01AD0BD9E FOREIGN KEY (culture_mere_id) REFERENCES culture_mere (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE culture_fille DROP FOREIGN KEY FK_30DE57A01AD0BD9E');
        $this->addSql('ALTER TABLE culture_fille ADD CONSTRAINT FK_30DE57A01AD0BD9E FOREIGN KEY (culture_mere_id) REFERENCES culture_mere (id)');
    }
}
