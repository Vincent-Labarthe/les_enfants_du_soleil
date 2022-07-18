<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220718113706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE health_event (id INT AUTO_INCREMENT NOT NULL, person_id INT NOT NULL, type VARCHAR(255) NOT NULL, is_disease TINYINT(1) NOT NULL, reason VARCHAR(255) DEFAULT NULL, diagnosis VARCHAR(255) DEFAULT NULL, imaging VARCHAR(255) DEFAULT NULL, treatment VARCHAR(255) DEFAULT NULL, comment VARCHAR(255) NOT NULL, consultation_cost NUMERIC(10, 0) DEFAULT NULL, drugs_cost NUMERIC(10, 0) DEFAULT NULL, other_cost NUMERIC(10, 0) DEFAULT NULL, INDEX IDX_606D216D217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE health_event ADD CONSTRAINT FK_606D216D217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE health_event');
    }
}
