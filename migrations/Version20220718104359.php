<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220718104359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, is_current_location TINYINT(1) NOT NULL, location_started_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', location_ended_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_location (person_id INT NOT NULL, location_id INT NOT NULL, INDEX IDX_CAD82CFC217BBB47 (person_id), INDEX IDX_CAD82CFC64D218E (location_id), PRIMARY KEY(person_id, location_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE person_location ADD CONSTRAINT FK_CAD82CFC217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person_location ADD CONSTRAINT FK_CAD82CFC64D218E FOREIGN KEY (location_id) REFERENCES location (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person_location DROP FOREIGN KEY FK_CAD82CFC64D218E');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE person_location');
    }
}
