<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220718110326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE person_sponsorship (person_id INT NOT NULL, sponsorship_id INT NOT NULL, INDEX IDX_AD1A535C217BBB47 (person_id), INDEX IDX_AD1A535C8ACED59A (sponsorship_id), PRIMARY KEY(person_id, sponsorship_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE person_sponsorship ADD CONSTRAINT FK_AD1A535C217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person_sponsorship ADD CONSTRAINT FK_AD1A535C8ACED59A FOREIGN KEY (sponsorship_id) REFERENCES sponsorship (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE person_sponsorship');
    }
}
