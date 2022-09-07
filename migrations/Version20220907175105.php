<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220907175105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CF77D927C');
        $this->addSql('DROP INDEX UNIQ_35D4282CF77D927C ON commandes');
        $this->addSql('ALTER TABLE commandes DROP panier_id, DROP nom_client, DROP email, DROP nb_commandes_passe, DROP date_inscription, DROP total_depense_sur_le_site, DROP etat_de_la_commande');
        $this->addSql('ALTER TABLE statut DROP panier');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes ADD panier_id INT DEFAULT NULL, ADD nom_client VARCHAR(50) NOT NULL, ADD email VARCHAR(50) NOT NULL, ADD nb_commandes_passe INT NOT NULL, ADD date_inscription DATETIME NOT NULL, ADD total_depense_sur_le_site DOUBLE PRECISION DEFAULT NULL, ADD etat_de_la_commande VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_35D4282CF77D927C ON commandes (panier_id)');
        $this->addSql('ALTER TABLE statut ADD panier INT NOT NULL');
    }
}
