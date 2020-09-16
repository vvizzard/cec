<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200916073924 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nbr_culture_agriculteur DROP FOREIGN KEY FK_B23F1B4D7EBB810E');
        $this->addSql('ALTER TABLE nbr_culture_agriculteur DROP FOREIGN KEY FK_B23F1B4DB108249D');
        $this->addSql('ALTER TABLE nbr_culture_agriculteur ADD CONSTRAINT FK_B23F1B4D7EBB810E FOREIGN KEY (agriculteur_id) REFERENCES agriculteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nbr_culture_agriculteur ADD CONSTRAINT FK_B23F1B4DB108249D FOREIGN KEY (culture_id) REFERENCES culture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nbr_equipement_agricole_agriculteur DROP FOREIGN KEY FK_32C0AD1C2C2FC99');
        $this->addSql('ALTER TABLE nbr_equipement_agricole_agriculteur DROP FOREIGN KEY FK_32C0AD1C7EBB810E');
        $this->addSql('ALTER TABLE nbr_equipement_agricole_agriculteur ADD CONSTRAINT FK_32C0AD1C2C2FC99 FOREIGN KEY (equipement_agricole_id) REFERENCES equipement_agricole (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nbr_equipement_agricole_agriculteur ADD CONSTRAINT FK_32C0AD1C7EBB810E FOREIGN KEY (agriculteur_id) REFERENCES agriculteur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nbr_culture_agriculteur DROP FOREIGN KEY FK_B23F1B4DB108249D');
        $this->addSql('ALTER TABLE nbr_culture_agriculteur DROP FOREIGN KEY FK_B23F1B4D7EBB810E');
        $this->addSql('ALTER TABLE nbr_culture_agriculteur ADD CONSTRAINT FK_B23F1B4DB108249D FOREIGN KEY (culture_id) REFERENCES culture (id)');
        $this->addSql('ALTER TABLE nbr_culture_agriculteur ADD CONSTRAINT FK_B23F1B4D7EBB810E FOREIGN KEY (agriculteur_id) REFERENCES agriculteur (id)');
        $this->addSql('ALTER TABLE nbr_equipement_agricole_agriculteur DROP FOREIGN KEY FK_32C0AD1C2C2FC99');
        $this->addSql('ALTER TABLE nbr_equipement_agricole_agriculteur DROP FOREIGN KEY FK_32C0AD1C7EBB810E');
        $this->addSql('ALTER TABLE nbr_equipement_agricole_agriculteur ADD CONSTRAINT FK_32C0AD1C2C2FC99 FOREIGN KEY (equipement_agricole_id) REFERENCES equipement_agricole (id)');
        $this->addSql('ALTER TABLE nbr_equipement_agricole_agriculteur ADD CONSTRAINT FK_32C0AD1C7EBB810E FOREIGN KEY (agriculteur_id) REFERENCES agriculteur (id)');
    }
}
