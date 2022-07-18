<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220718110508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sponsorship ADD sponsor_id INT NOT NULL');
        $this->addSql('ALTER TABLE sponsorship ADD CONSTRAINT FK_C0F10CD412F7FB51 FOREIGN KEY (sponsor_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_C0F10CD412F7FB51 ON sponsorship (sponsor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sponsorship DROP FOREIGN KEY FK_C0F10CD412F7FB51');
        $this->addSql('DROP INDEX IDX_C0F10CD412F7FB51 ON sponsorship');
        $this->addSql('ALTER TABLE sponsorship DROP sponsor_id');
    }
}
