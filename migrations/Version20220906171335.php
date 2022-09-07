<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220906171335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE panier_produits (panier_id INT NOT NULL, produits_id INT NOT NULL, INDEX IDX_2468D6FEF77D927C (panier_id), INDEX IDX_2468D6FECD11A2CF (produits_id), PRIMARY KEY(panier_id, produits_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reduction (id INT AUTO_INCREMENT NOT NULL, pourcentage_reduction VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, panier INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE panier_produits ADD CONSTRAINT FK_2468D6FEF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier_produits ADD CONSTRAINT FK_2468D6FECD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE detail_panier');
        $this->addSql('ALTER TABLE adresse ADD commandes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F08168BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_C35F08168BF5C2E6 ON adresse (commandes_id)');
        $this->addSql('ALTER TABLE avis ADD clients_id INT DEFAULT NULL, ADD produits_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0AB014612 FOREIGN KEY (clients_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0CD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF0AB014612 ON avis (clients_id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF0CD11A2CF ON avis (produits_id)');
        $this->addSql('ALTER TABLE clients ADD moyen_paiement_id INT DEFAULT NULL, ADD panier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E749C7E259C FOREIGN KEY (moyen_paiement_id) REFERENCES moyen_paiement (id)');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E74F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('CREATE INDEX IDX_C82E749C7E259C ON clients (moyen_paiement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C82E74F77D927C ON clients (panier_id)');
        $this->addSql('ALTER TABLE commandes ADD moyen_paiement_id INT DEFAULT NULL, ADD panier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C9C7E259C FOREIGN KEY (moyen_paiement_id) REFERENCES moyen_paiement (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('CREATE INDEX IDX_35D4282C9C7E259C ON commandes (moyen_paiement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_35D4282CF77D927C ON commandes (panier_id)');
        $this->addSql('ALTER TABLE produits ADD reduction_id INT DEFAULT NULL, ADD categorie_produit_id INT DEFAULT NULL, ADD marques_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CC03CB092 FOREIGN KEY (reduction_id) REFERENCES reduction (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C91FDB457 FOREIGN KEY (categorie_produit_id) REFERENCES categorie_produit (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CC256483C FOREIGN KEY (marques_id) REFERENCES marques (id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8CC03CB092 ON produits (reduction_id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C91FDB457 ON produits (categorie_produit_id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8CC256483C ON produits (marques_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CC03CB092');
        $this->addSql('CREATE TABLE detail_panier (id INT AUTO_INCREMENT NOT NULL, quantite_article INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE panier_produits');
        $this->addSql('DROP TABLE reduction');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F08168BF5C2E6');
        $this->addSql('DROP INDEX IDX_C35F08168BF5C2E6 ON adresse');
        $this->addSql('ALTER TABLE adresse DROP commandes_id');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0AB014612');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0CD11A2CF');
        $this->addSql('DROP INDEX IDX_8F91ABF0AB014612 ON avis');
        $this->addSql('DROP INDEX IDX_8F91ABF0CD11A2CF ON avis');
        $this->addSql('ALTER TABLE avis DROP clients_id, DROP produits_id');
        $this->addSql('ALTER TABLE clients DROP FOREIGN KEY FK_C82E749C7E259C');
        $this->addSql('ALTER TABLE clients DROP FOREIGN KEY FK_C82E74F77D927C');
        $this->addSql('DROP INDEX IDX_C82E749C7E259C ON clients');
        $this->addSql('DROP INDEX UNIQ_C82E74F77D927C ON clients');
        $this->addSql('ALTER TABLE clients DROP moyen_paiement_id, DROP panier_id');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C9C7E259C');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CF77D927C');
        $this->addSql('DROP INDEX IDX_35D4282C9C7E259C ON commandes');
        $this->addSql('DROP INDEX UNIQ_35D4282CF77D927C ON commandes');
        $this->addSql('ALTER TABLE commandes DROP moyen_paiement_id, DROP panier_id');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C91FDB457');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CC256483C');
        $this->addSql('DROP INDEX IDX_BE2DDF8CC03CB092 ON produits');
        $this->addSql('DROP INDEX IDX_BE2DDF8C91FDB457 ON produits');
        $this->addSql('DROP INDEX IDX_BE2DDF8CC256483C ON produits');
        $this->addSql('ALTER TABLE produits DROP reduction_id, DROP categorie_produit_id, DROP marques_id');
    }
}
