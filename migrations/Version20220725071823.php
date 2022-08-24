<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725071823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_medical_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE medical_event');
        $this->addSql('ALTER TABLE health_event ADD event_medical_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE health_event ADD CONSTRAINT FK_606D216D4A9D086D FOREIGN KEY (event_medical_type_id) REFERENCES event_medical_type (id)');
        $this->addSql('CREATE INDEX IDX_606D216D4A9D086D ON health_event (event_medical_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE health_event DROP FOREIGN KEY FK_606D216D4A9D086D');
        $this->addSql('CREATE TABLE medical_event (id INT AUTO_INCREMENT NOT NULL, health_event_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_E4851F799D29525 (health_event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE medical_event ADD CONSTRAINT FK_E4851F799D29525 FOREIGN KEY (health_event_id) REFERENCES health_event (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE event_medical_type');
        $this->addSql('DROP INDEX IDX_606D216D4A9D086D ON health_event');
        $this->addSql('ALTER TABLE health_event DROP event_medical_type_id');
    }
}
