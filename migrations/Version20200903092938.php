<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200903092938 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agriculteur ADD acces_eau_potable TINYINT(1) DEFAULT NULL, ADD toilette SMALLINT DEFAULT NULL, ADD douche SMALLINT DEFAULT NULL, ADD assainissement SMALLINT DEFAULT NULL, ADD acces_education SMALLINT DEFAULT NULL, ADD medecin_traditionnel TINYINT(1) DEFAULT NULL, ADD medecin_conventionnel TINYINT(1) DEFAULT NULL, ADD longitude VARCHAR(100) DEFAULT NULL, ADD latitude VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agriculteur DROP acces_eau_potable, DROP toilette, DROP douche, DROP assainissement, DROP acces_education, DROP medecin_traditionnel, DROP medecin_conventionnel, DROP longitude, DROP latitude');
    }
}
