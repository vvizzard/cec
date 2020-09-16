<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200916074659 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE culture_fille DROP FOREIGN KEY FK_30DE57A0177B16E8');
        $this->addSql('ALTER TABLE culture_fille ADD CONSTRAINT FK_30DE57A0177B16E8 FOREIGN KEY (plante_id) REFERENCES culture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nbr_elevage_agriculteur DROP FOREIGN KEY FK_335A5D384E2F28D');
        $this->addSql('ALTER TABLE nbr_elevage_agriculteur DROP FOREIGN KEY FK_335A5D387EBB810E');
        $this->addSql('ALTER TABLE nbr_elevage_agriculteur ADD CONSTRAINT FK_335A5D384E2F28D FOREIGN KEY (elevage_id) REFERENCES elevage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nbr_elevage_agriculteur ADD CONSTRAINT FK_335A5D387EBB810E FOREIGN KEY (agriculteur_id) REFERENCES agriculteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parcelle DROP FOREIGN KEY FK_C56E2CF67EBB810E');
        $this->addSql('ALTER TABLE parcelle ADD CONSTRAINT FK_C56E2CF67EBB810E FOREIGN KEY (agriculteur_id) REFERENCES agriculteur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE culture_fille DROP FOREIGN KEY FK_30DE57A0177B16E8');
        $this->addSql('ALTER TABLE culture_fille ADD CONSTRAINT FK_30DE57A0177B16E8 FOREIGN KEY (plante_id) REFERENCES culture (id)');
        $this->addSql('ALTER TABLE nbr_elevage_agriculteur DROP FOREIGN KEY FK_335A5D387EBB810E');
        $this->addSql('ALTER TABLE nbr_elevage_agriculteur DROP FOREIGN KEY FK_335A5D384E2F28D');
        $this->addSql('ALTER TABLE nbr_elevage_agriculteur ADD CONSTRAINT FK_335A5D387EBB810E FOREIGN KEY (agriculteur_id) REFERENCES agriculteur (id)');
        $this->addSql('ALTER TABLE nbr_elevage_agriculteur ADD CONSTRAINT FK_335A5D384E2F28D FOREIGN KEY (elevage_id) REFERENCES elevage (id)');
        $this->addSql('ALTER TABLE parcelle DROP FOREIGN KEY FK_C56E2CF67EBB810E');
        $this->addSql('ALTER TABLE parcelle ADD CONSTRAINT FK_C56E2CF67EBB810E FOREIGN KEY (agriculteur_id) REFERENCES agriculteur (id)');
    }
}
