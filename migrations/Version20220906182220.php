<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220906182220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C91FDB457');
        $this->addSql('DROP INDEX IDX_BE2DDF8C91FDB457 ON produits');
        $this->addSql('ALTER TABLE produits DROP categorie_produit_id, DROP marque, DROP categorie_appartenant');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits ADD categorie_produit_id INT DEFAULT NULL, ADD marque VARCHAR(50) DEFAULT NULL, ADD categorie_appartenant VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C91FDB457 FOREIGN KEY (categorie_produit_id) REFERENCES categorie_produit (id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C91FDB457 ON produits (categorie_produit_id)');
    }
}
