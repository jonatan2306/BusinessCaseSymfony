<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220907175414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F08168BF5C2E6');
        $this->addSql('DROP INDEX IDX_C35F08168BF5C2E6 ON adresse');
        $this->addSql('ALTER TABLE adresse DROP commandes_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse ADD commandes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F08168BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_C35F08168BF5C2E6 ON adresse (commandes_id)');
    }
}