<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200812113758 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE age_plant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE controlle_biomas (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE culture_fille (id INT AUTO_INCREMENT NOT NULL, plante_id INT NOT NULL, variete_id INT DEFAULT NULL, age_plant_id INT DEFAULT NULL, culture_mere_id INT DEFAULT NULL, date_plantation DATE DEFAULT NULL, qte_semence NUMERIC(10, 2) DEFAULT NULL, production NUMERIC(10, 2) DEFAULT NULL, rdt NUMERIC(10, 2) DEFAULT NULL, INDEX IDX_30DE57A0177B16E8 (plante_id), INDEX IDX_30DE57A0620D5460 (variete_id), INDEX IDX_30DE57A05359AD1B (age_plant_id), INDEX IDX_30DE57A01AD0BD9E (culture_mere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE culture_mere (id INT AUTO_INCREMENT NOT NULL, cycle_agricole_id INT DEFAULT NULL, precedent_cultural_id INT DEFAULT NULL, systeme_cultural_id INT DEFAULT NULL, itineraire_cultural_id INT DEFAULT NULL, etat_pc_id INT DEFAULT NULL, etat_mulch_id INT DEFAULT NULL, preparation_parcelle_id INT DEFAULT NULL, controlle_biomas_id INT DEFAULT NULL, mode_installation_id INT DEFAULT NULL, type_pepiniere_id INT DEFAULT NULL, mode_repiquage_id INT DEFAULT NULL, type_sarclage_id INT DEFAULT NULL, degat_cyclonique_id INT DEFAULT NULL, sondage_qualitatif_id INT DEFAULT NULL, parcelle_id INT DEFAULT NULL, nouvelle_plantation TINYINT(1) DEFAULT NULL, surface_cultive NUMERIC(10, 2) DEFAULT NULL, mo_preparation_sol SMALLINT DEFAULT NULL, mo_installation_culture SMALLINT DEFAULT NULL, mo_entretien1 INT DEFAULT NULL, mo_entretien2 INT DEFAULT NULL, mo_entretien3 INT DEFAULT NULL, mo_recolte INT DEFAULT NULL, mo_ext_preparation_sol INT DEFAULT NULL, mo_ext_installation_culture INT DEFAULT NULL, mo_ext_entretien1 INT DEFAULT NULL, mo_ext_entretien2 INT DEFAULT NULL, mo_ext_entretien3 INT DEFAULT NULL, mo_ext_recolte INT DEFAULT NULL, date_plantation DATE DEFAULT NULL, age_plantation SMALLINT DEFAULT NULL, qte_fumure_organique NUMERIC(6, 2) DEFAULT NULL, qte_insecticide NUMERIC(6, 2) DEFAULT NULL, mis_en_cloture TINYINT(1) DEFAULT NULL, nbr_sarclage INT DEFAULT NULL, utilisation_pc_fourage TINYINT(1) DEFAULT NULL, mis_en_culture TINYINT(1) DEFAULT NULL, utilisation_pc_paillage_sur_autre_parcelle TINYINT(1) DEFAULT NULL, utilisation_pc_compost TINYINT(1) DEFAULT NULL, basket_compost TINYINT(1) DEFAULT NULL, rente TINYINT(1) DEFAULT NULL, ecobuage TINYINT(1) DEFAULT NULL, sondage_rendement TINYINT(1) DEFAULT NULL, pmg INT DEFAULT NULL, remarque_avsf VARCHAR(255) DEFAULT NULL, annee_agricole_avsf VARCHAR(100) DEFAULT NULL, INDEX IDX_1744C0B27A83B1C4 (cycle_agricole_id), INDEX IDX_1744C0B2A3EB127F (precedent_cultural_id), INDEX IDX_1744C0B2E42CAA0B (systeme_cultural_id), INDEX IDX_1744C0B2EF03C545 (itineraire_cultural_id), INDEX IDX_1744C0B2C9F47FA4 (etat_pc_id), INDEX IDX_1744C0B2CB7F3C6D (etat_mulch_id), INDEX IDX_1744C0B264CE9167 (preparation_parcelle_id), INDEX IDX_1744C0B2AE936322 (controlle_biomas_id), INDEX IDX_1744C0B252A0E116 (mode_installation_id), INDEX IDX_1744C0B26A4AF869 (type_pepiniere_id), INDEX IDX_1744C0B2BD4A59D9 (mode_repiquage_id), INDEX IDX_1744C0B2C81E3BEA (type_sarclage_id), INDEX IDX_1744C0B2562A46C1 (degat_cyclonique_id), INDEX IDX_1744C0B295CEBCE0 (sondage_qualitatif_id), INDEX IDX_1744C0B24433ED66 (parcelle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cycle_agricole (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE degat_cyclonique (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat_mulch (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat_pc (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fumure_organique (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE insecticide (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itineraire_cultural (id INT AUTO_INCREMENT NOT NULL, systeme_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, riz TINYINT(1) DEFAULT NULL, vivrier_hors TINYINT(1) DEFAULT NULL, rmme TINYINT(1) DEFAULT NULL, pc_en_pure TINYINT(1) DEFAULT NULL, couverture_culture_rente TINYINT(1) DEFAULT NULL, reforestation TINYINT(1) DEFAULT NULL, culture_rente TINYINT(1) DEFAULT NULL, pc_associe TINYINT(1) DEFAULT NULL, INDEX IDX_26FC1CA3346F772E (systeme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode_installation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode_repiquage (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nbr_fumure_culture_m (id INT AUTO_INCREMENT NOT NULL, fumure_id INT DEFAULT NULL, culture_id INT DEFAULT NULL, nbr INT NOT NULL, INDEX IDX_E9E1DD168AA46A9F (fumure_id), INDEX IDX_E9E1DD16B108249D (culture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nbr_insecticide_culture_m (id INT AUTO_INCREMENT NOT NULL, insecticide_id INT DEFAULT NULL, culture_id INT DEFAULT NULL, nbr INT NOT NULL, INDEX IDX_E2478F941A6E270 (insecticide_id), INDEX IDX_E2478F9B108249D (culture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE precedent_cultural (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, installe_sur_pdt TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preparation_parcelle (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sondage_qualitatif (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE systeme_cultural (id INT AUTO_INCREMENT NOT NULL, milieu_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, systeme_cultural_export VARCHAR(100) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_97CACABA735F057F (milieu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_pepiniere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_sarclage (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE variete (id INT AUTO_INCREMENT NOT NULL, culture_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_2CD7CD58B108249D (culture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE culture_fille ADD CONSTRAINT FK_30DE57A0177B16E8 FOREIGN KEY (plante_id) REFERENCES culture (id)');
        $this->addSql('ALTER TABLE culture_fille ADD CONSTRAINT FK_30DE57A0620D5460 FOREIGN KEY (variete_id) REFERENCES variete (id)');
        $this->addSql('ALTER TABLE culture_fille ADD CONSTRAINT FK_30DE57A05359AD1B FOREIGN KEY (age_plant_id) REFERENCES age_plant (id)');
        $this->addSql('ALTER TABLE culture_fille ADD CONSTRAINT FK_30DE57A01AD0BD9E FOREIGN KEY (culture_mere_id) REFERENCES culture_mere (id)');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B27A83B1C4 FOREIGN KEY (cycle_agricole_id) REFERENCES cycle_agricole (id)');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B2A3EB127F FOREIGN KEY (precedent_cultural_id) REFERENCES precedent_cultural (id)');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B2E42CAA0B FOREIGN KEY (systeme_cultural_id) REFERENCES systeme_cultural (id)');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B2EF03C545 FOREIGN KEY (itineraire_cultural_id) REFERENCES itineraire_cultural (id)');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B2C9F47FA4 FOREIGN KEY (etat_pc_id) REFERENCES etat_pc (id)');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B2CB7F3C6D FOREIGN KEY (etat_mulch_id) REFERENCES etat_mulch (id)');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B264CE9167 FOREIGN KEY (preparation_parcelle_id) REFERENCES preparation_parcelle (id)');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B2AE936322 FOREIGN KEY (controlle_biomas_id) REFERENCES controlle_biomas (id)');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B252A0E116 FOREIGN KEY (mode_installation_id) REFERENCES mode_installation (id)');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B26A4AF869 FOREIGN KEY (type_pepiniere_id) REFERENCES type_pepiniere (id)');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B2BD4A59D9 FOREIGN KEY (mode_repiquage_id) REFERENCES mode_repiquage (id)');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B2C81E3BEA FOREIGN KEY (type_sarclage_id) REFERENCES type_sarclage (id)');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B2562A46C1 FOREIGN KEY (degat_cyclonique_id) REFERENCES degat_cyclonique (id)');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B295CEBCE0 FOREIGN KEY (sondage_qualitatif_id) REFERENCES sondage_qualitatif (id)');
        $this->addSql('ALTER TABLE culture_mere ADD CONSTRAINT FK_1744C0B24433ED66 FOREIGN KEY (parcelle_id) REFERENCES parcelle (id)');
        $this->addSql('ALTER TABLE itineraire_cultural ADD CONSTRAINT FK_26FC1CA3346F772E FOREIGN KEY (systeme_id) REFERENCES systeme_cultural (id)');
        $this->addSql('ALTER TABLE nbr_fumure_culture_m ADD CONSTRAINT FK_E9E1DD168AA46A9F FOREIGN KEY (fumure_id) REFERENCES fumure_organique (id)');
        $this->addSql('ALTER TABLE nbr_fumure_culture_m ADD CONSTRAINT FK_E9E1DD16B108249D FOREIGN KEY (culture_id) REFERENCES culture_mere (id)');
        $this->addSql('ALTER TABLE nbr_insecticide_culture_m ADD CONSTRAINT FK_E2478F941A6E270 FOREIGN KEY (insecticide_id) REFERENCES insecticide (id)');
        $this->addSql('ALTER TABLE nbr_insecticide_culture_m ADD CONSTRAINT FK_E2478F9B108249D FOREIGN KEY (culture_id) REFERENCES culture_mere (id)');
        $this->addSql('ALTER TABLE systeme_cultural ADD CONSTRAINT FK_97CACABA735F057F FOREIGN KEY (milieu_id) REFERENCES milieu (id)');
        $this->addSql('ALTER TABLE variete ADD CONSTRAINT FK_2CD7CD58B108249D FOREIGN KEY (culture_id) REFERENCES culture (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE culture_fille DROP FOREIGN KEY FK_30DE57A05359AD1B');
        $this->addSql('ALTER TABLE culture_mere DROP FOREIGN KEY FK_1744C0B2AE936322');
        $this->addSql('ALTER TABLE culture_fille DROP FOREIGN KEY FK_30DE57A01AD0BD9E');
        $this->addSql('ALTER TABLE nbr_fumure_culture_m DROP FOREIGN KEY FK_E9E1DD16B108249D');
        $this->addSql('ALTER TABLE nbr_insecticide_culture_m DROP FOREIGN KEY FK_E2478F9B108249D');
        $this->addSql('ALTER TABLE culture_mere DROP FOREIGN KEY FK_1744C0B27A83B1C4');
        $this->addSql('ALTER TABLE culture_mere DROP FOREIGN KEY FK_1744C0B2562A46C1');
        $this->addSql('ALTER TABLE culture_mere DROP FOREIGN KEY FK_1744C0B2CB7F3C6D');
        $this->addSql('ALTER TABLE culture_mere DROP FOREIGN KEY FK_1744C0B2C9F47FA4');
        $this->addSql('ALTER TABLE nbr_fumure_culture_m DROP FOREIGN KEY FK_E9E1DD168AA46A9F');
        $this->addSql('ALTER TABLE nbr_insecticide_culture_m DROP FOREIGN KEY FK_E2478F941A6E270');
        $this->addSql('ALTER TABLE culture_mere DROP FOREIGN KEY FK_1744C0B2EF03C545');
        $this->addSql('ALTER TABLE culture_mere DROP FOREIGN KEY FK_1744C0B252A0E116');
        $this->addSql('ALTER TABLE culture_mere DROP FOREIGN KEY FK_1744C0B2BD4A59D9');
        $this->addSql('ALTER TABLE culture_mere DROP FOREIGN KEY FK_1744C0B2A3EB127F');
        $this->addSql('ALTER TABLE culture_mere DROP FOREIGN KEY FK_1744C0B264CE9167');
        $this->addSql('ALTER TABLE culture_mere DROP FOREIGN KEY FK_1744C0B295CEBCE0');
        $this->addSql('ALTER TABLE culture_mere DROP FOREIGN KEY FK_1744C0B2E42CAA0B');
        $this->addSql('ALTER TABLE itineraire_cultural DROP FOREIGN KEY FK_26FC1CA3346F772E');
        $this->addSql('ALTER TABLE culture_mere DROP FOREIGN KEY FK_1744C0B26A4AF869');
        $this->addSql('ALTER TABLE culture_mere DROP FOREIGN KEY FK_1744C0B2C81E3BEA');
        $this->addSql('ALTER TABLE culture_fille DROP FOREIGN KEY FK_30DE57A0620D5460');
        $this->addSql('DROP TABLE age_plant');
        $this->addSql('DROP TABLE controlle_biomas');
        $this->addSql('DROP TABLE culture_fille');
        $this->addSql('DROP TABLE culture_mere');
        $this->addSql('DROP TABLE cycle_agricole');
        $this->addSql('DROP TABLE degat_cyclonique');
        $this->addSql('DROP TABLE etat_mulch');
        $this->addSql('DROP TABLE etat_pc');
        $this->addSql('DROP TABLE fumure_organique');
        $this->addSql('DROP TABLE insecticide');
        $this->addSql('DROP TABLE itineraire_cultural');
        $this->addSql('DROP TABLE mode_installation');
        $this->addSql('DROP TABLE mode_repiquage');
        $this->addSql('DROP TABLE nbr_fumure_culture_m');
        $this->addSql('DROP TABLE nbr_insecticide_culture_m');
        $this->addSql('DROP TABLE precedent_cultural');
        $this->addSql('DROP TABLE preparation_parcelle');
        $this->addSql('DROP TABLE sondage_qualitatif');
        $this->addSql('DROP TABLE systeme_cultural');
        $this->addSql('DROP TABLE type_pepiniere');
        $this->addSql('DROP TABLE type_sarclage');
        $this->addSql('DROP TABLE variete');
    }
}
