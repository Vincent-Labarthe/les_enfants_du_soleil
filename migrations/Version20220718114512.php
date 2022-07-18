<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220718114512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, organization_id INT NOT NULL, class VARCHAR(255) NOT NULL, specialty VARCHAR(255) NOT NULL, result VARCHAR(255) DEFAULT NULL, suggested_direction VARCHAR(255) DEFAULT NULL, ended_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_404021BF32C8A3DE (organization_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_person (formation_id INT NOT NULL, person_id INT NOT NULL, INDEX IDX_14C5DF5B5200282E (formation_id), INDEX IDX_14C5DF5B217BBB47 (person_id), PRIMARY KEY(formation_id, person_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF32C8A3DE FOREIGN KEY (organization_id) REFERENCES organization (id)');
        $this->addSql('ALTER TABLE formation_person ADD CONSTRAINT FK_14C5DF5B5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_person ADD CONSTRAINT FK_14C5DF5B217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation_person DROP FOREIGN KEY FK_14C5DF5B5200282E');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formation_person');
    }
}
