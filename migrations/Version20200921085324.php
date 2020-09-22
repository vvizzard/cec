<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200921085324 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agriculteur ADD cereale SMALLINT DEFAULT NULL, ADD legume_sec SMALLINT DEFAULT NULL, ADD legume SMALLINT DEFAULT NULL, ADD fruit SMALLINT DEFAULT NULL, ADD viande SMALLINT DEFAULT NULL, ADD lait SMALLINT DEFAULT NULL, ADD sucre SMALLINT DEFAULT NULL, ADD huile SMALLINT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agriculteur DROP cereale, DROP legume_sec, DROP legume, DROP fruit, DROP viande, DROP lait, DROP sucre, DROP huile');
    }
}
