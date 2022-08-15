<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220812073855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person ADD eds_entity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD1767F0FF87C FOREIGN KEY (eds_entity_id) REFERENCES eds_entity (id)');
        $this->addSql('CREATE INDEX IDX_34DCD1767F0FF87C ON person (eds_entity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD1767F0FF87C');
        $this->addSql('DROP INDEX IDX_34DCD1767F0FF87C ON person');
        $this->addSql('ALTER TABLE person DROP eds_entity_id');
    }
}
