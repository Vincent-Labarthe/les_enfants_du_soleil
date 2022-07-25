<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725072113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_behavior_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE behavior_event ADD event_behavior_type_id INT NOT NULL, DROP type');
        $this->addSql('ALTER TABLE behavior_event ADD CONSTRAINT FK_692FFEADA363E355 FOREIGN KEY (event_behavior_type_id) REFERENCES event_behavior_type (id)');
        $this->addSql('CREATE INDEX IDX_692FFEADA363E355 ON behavior_event (event_behavior_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE behavior_event DROP FOREIGN KEY FK_692FFEADA363E355');
        $this->addSql('DROP TABLE event_behavior_type');
        $this->addSql('DROP INDEX IDX_692FFEADA363E355 ON behavior_event');
        $this->addSql('ALTER TABLE behavior_event ADD type VARCHAR(255) NOT NULL, DROP event_behavior_type_id');
    }
}
