<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201001070700 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nbr_fumure_culture_m CHANGE nbr nbr NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE nbr_insecticide_culture_m CHANGE nbr nbr NUMERIC(10, 2) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nbr_fumure_culture_m CHANGE nbr nbr INT NOT NULL');
        $this->addSql('ALTER TABLE nbr_insecticide_culture_m CHANGE nbr nbr INT NOT NULL');
    }
}
