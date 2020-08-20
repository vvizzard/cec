<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200818163545 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agriculteur ADD calendrier SMALLINT DEFAULT NULL, ADD outil_ameliore SMALLINT DEFAULT NULL, ADD difference_besoins_alimentaire TINYINT(1) DEFAULT NULL, ADD connaissance_difference_besoins_alimentaire TINYINT(1) DEFAULT NULL, ADD regime_alimentaire_variee TINYINT(1) DEFAULT NULL, ADD assurance_produit_necessaire_alimentation SMALLINT DEFAULT NULL, ADD enregistrement_mouvement_argent TINYINT(1) DEFAULT NULL, ADD enregistrement_mouvement_argent_why SMALLINT DEFAULT NULL, ADD epargne SMALLINT DEFAULT NULL, ADD connaissance_demande_cours_produit_agricole TINYINT(1) DEFAULT NULL, ADD connaissance_demande_cours_produit_agricole_why SMALLINT DEFAULT NULL, ADD ameliorer_qualite_produit TINYINT(1) DEFAULT NULL, ADD ameliorer_qualite_produit_why SMALLINT DEFAULT NULL, ADD groupement TINYINT(1) DEFAULT NULL, ADD avantage_regroupement SMALLINT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agriculteur DROP calendrier, DROP outil_ameliore, DROP difference_besoins_alimentaire, DROP connaissance_difference_besoins_alimentaire, DROP regime_alimentaire_variee, DROP assurance_produit_necessaire_alimentation, DROP enregistrement_mouvement_argent, DROP enregistrement_mouvement_argent_why, DROP epargne, DROP connaissance_demande_cours_produit_agricole, DROP connaissance_demande_cours_produit_agricole_why, DROP ameliorer_qualite_produit, DROP ameliorer_qualite_produit_why, DROP groupement, DROP avantage_regroupement');
    }
}
