<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220906174026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sous_category (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_E022D94BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sous_category ADD CONSTRAINT FK_E022D94BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_produit (id)');
        $this->addSql('ALTER TABLE categorie_produit DROP type, DROP type_categorie');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sous_category');
        $this->addSql('ALTER TABLE categorie_produit ADD type VARCHAR(10) NOT NULL, ADD type_categorie VARCHAR(10) NOT NULL');
    }
}
