<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220718103925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, current_site_attachment VARCHAR(255) DEFAULT NULL, degree VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, family_relation VARCHAR(255) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, last_grade_level VARCHAR(255) NOT NULL, support_started_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', support_ended_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', tel VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE person');
    }
}
