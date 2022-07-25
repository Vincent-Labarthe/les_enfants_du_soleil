<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725072959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job ADD ended_at DATETIME DEFAULT NULL, DROP job_ended_at, CHANGE started_at started_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD1767F0FF87C');
        $this->addSql('DROP INDEX IDX_34DCD1767F0FF87C ON person');
        $this->addSql('ALTER TABLE person CHANGE eds_entity_id eds_manage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176F850C50 FOREIGN KEY (eds_manage_id) REFERENCES eds_entity (id)');
        $this->addSql('CREATE INDEX IDX_34DCD176F850C50 ON person (eds_manage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job ADD job_ended_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP ended_at, CHANGE started_at started_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176F850C50');
        $this->addSql('DROP INDEX IDX_34DCD176F850C50 ON person');
        $this->addSql('ALTER TABLE person CHANGE eds_manage_id eds_entity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD1767F0FF87C FOREIGN KEY (eds_entity_id) REFERENCES eds_entity (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_34DCD1767F0FF87C ON person (eds_entity_id)');
    }
}
