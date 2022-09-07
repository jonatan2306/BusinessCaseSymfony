<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220907175941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes ADD user_id INT DEFAULT NULL, ADD adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('CREATE INDEX IDX_35D4282CA76ED395 ON commandes (user_id)');
        $this->addSql('CREATE INDEX IDX_35D4282C4DE7DC5C ON commandes (adresse_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CA76ED395');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C4DE7DC5C');
        $this->addSql('DROP INDEX IDX_35D4282CA76ED395 ON commandes');
        $this->addSql('DROP INDEX IDX_35D4282C4DE7DC5C ON commandes');
        $this->addSql('ALTER TABLE commandes DROP user_id, DROP adresse_id');
    }
}
