<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200916081450 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nbr_fumure_culture_m DROP FOREIGN KEY FK_E9E1DD168AA46A9F');
        $this->addSql('ALTER TABLE nbr_fumure_culture_m DROP FOREIGN KEY FK_E9E1DD16B108249D');
        $this->addSql('ALTER TABLE nbr_fumure_culture_m ADD CONSTRAINT FK_E9E1DD168AA46A9F FOREIGN KEY (fumure_id) REFERENCES fumure_organique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nbr_fumure_culture_m ADD CONSTRAINT FK_E9E1DD16B108249D FOREIGN KEY (culture_id) REFERENCES culture_mere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nbr_insecticide_culture_m DROP FOREIGN KEY FK_E2478F941A6E270');
        $this->addSql('ALTER TABLE nbr_insecticide_culture_m DROP FOREIGN KEY FK_E2478F9B108249D');
        $this->addSql('ALTER TABLE nbr_insecticide_culture_m ADD CONSTRAINT FK_E2478F941A6E270 FOREIGN KEY (insecticide_id) REFERENCES insecticide (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nbr_insecticide_culture_m ADD CONSTRAINT FK_E2478F9B108249D FOREIGN KEY (culture_id) REFERENCES culture_mere (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nbr_fumure_culture_m DROP FOREIGN KEY FK_E9E1DD168AA46A9F');
        $this->addSql('ALTER TABLE nbr_fumure_culture_m DROP FOREIGN KEY FK_E9E1DD16B108249D');
        $this->addSql('ALTER TABLE nbr_fumure_culture_m ADD CONSTRAINT FK_E9E1DD168AA46A9F FOREIGN KEY (fumure_id) REFERENCES fumure_organique (id)');
        $this->addSql('ALTER TABLE nbr_fumure_culture_m ADD CONSTRAINT FK_E9E1DD16B108249D FOREIGN KEY (culture_id) REFERENCES culture_mere (id)');
        $this->addSql('ALTER TABLE nbr_insecticide_culture_m DROP FOREIGN KEY FK_E2478F941A6E270');
        $this->addSql('ALTER TABLE nbr_insecticide_culture_m DROP FOREIGN KEY FK_E2478F9B108249D');
        $this->addSql('ALTER TABLE nbr_insecticide_culture_m ADD CONSTRAINT FK_E2478F941A6E270 FOREIGN KEY (insecticide_id) REFERENCES insecticide (id)');
        $this->addSql('ALTER TABLE nbr_insecticide_culture_m ADD CONSTRAINT FK_E2478F9B108249D FOREIGN KEY (culture_id) REFERENCES culture_mere (id)');
    }
}
