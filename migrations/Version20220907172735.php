<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220907172735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produits_categorie_produit (produits_id INT NOT NULL, categorie_produit_id INT NOT NULL, INDEX IDX_4F2E1F61CD11A2CF (produits_id), INDEX IDX_4F2E1F6191FDB457 (categorie_produit_id), PRIMARY KEY(produits_id, categorie_produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produits_categorie_produit ADD CONSTRAINT FK_4F2E1F61CD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produits_categorie_produit ADD CONSTRAINT FK_4F2E1F6191FDB457 FOREIGN KEY (categorie_produit_id) REFERENCES categorie_produit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE produits_categorie_produit');
    }
}
