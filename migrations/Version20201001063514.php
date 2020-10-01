<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201001063514 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE culture_mere CHANGE mo_preparation_sol mo_preparation_sol NUMERIC(6, 2) DEFAULT NULL, CHANGE mo_installation_culture mo_installation_culture NUMERIC(6, 2) DEFAULT NULL, CHANGE mo_entretien1 mo_entretien1 NUMERIC(6, 2) DEFAULT NULL, CHANGE mo_entretien2 mo_entretien2 NUMERIC(6, 2) DEFAULT NULL, CHANGE mo_entretien3 mo_entretien3 NUMERIC(6, 2) DEFAULT NULL, CHANGE mo_recolte mo_recolte NUMERIC(6, 2) DEFAULT NULL, CHANGE mo_ext_preparation_sol mo_ext_preparation_sol NUMERIC(6, 2) DEFAULT NULL, CHANGE mo_ext_installation_culture mo_ext_installation_culture NUMERIC(6, 2) DEFAULT NULL, CHANGE mo_ext_entretien1 mo_ext_entretien1 NUMERIC(6, 2) DEFAULT NULL, CHANGE mo_ext_entretien2 mo_ext_entretien2 NUMERIC(6, 2) DEFAULT NULL, CHANGE mo_ext_entretien3 mo_ext_entretien3 NUMERIC(6, 2) DEFAULT NULL, CHANGE mo_ext_recolte mo_ext_recolte NUMERIC(6, 2) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE culture_mere CHANGE mo_preparation_sol mo_preparation_sol NUMERIC(10, 0) DEFAULT NULL, CHANGE mo_installation_culture mo_installation_culture NUMERIC(10, 0) DEFAULT NULL, CHANGE mo_entretien1 mo_entretien1 NUMERIC(10, 0) DEFAULT NULL, CHANGE mo_entretien2 mo_entretien2 NUMERIC(10, 0) DEFAULT NULL, CHANGE mo_entretien3 mo_entretien3 NUMERIC(10, 0) DEFAULT NULL, CHANGE mo_recolte mo_recolte NUMERIC(10, 0) DEFAULT NULL, CHANGE mo_ext_preparation_sol mo_ext_preparation_sol NUMERIC(10, 0) DEFAULT NULL, CHANGE mo_ext_installation_culture mo_ext_installation_culture NUMERIC(10, 0) DEFAULT NULL, CHANGE mo_ext_entretien1 mo_ext_entretien1 NUMERIC(10, 0) DEFAULT NULL, CHANGE mo_ext_entretien2 mo_ext_entretien2 NUMERIC(10, 0) DEFAULT NULL, CHANGE mo_ext_entretien3 mo_ext_entretien3 NUMERIC(10, 0) DEFAULT NULL, CHANGE mo_ext_recolte mo_ext_recolte NUMERIC(10, 0) DEFAULT NULL');
    }
}
