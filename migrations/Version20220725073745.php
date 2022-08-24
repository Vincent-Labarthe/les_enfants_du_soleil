<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725073745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF32C8A3DE');
        $this->addSql('DROP INDEX IDX_404021BF32C8A3DE ON formation');
        $this->addSql('ALTER TABLE formation CHANGE ended_at ended_at DATETIME DEFAULT NULL, CHANGE organization_id training_institution_id INT NOT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF9736533B FOREIGN KEY (training_institution_id) REFERENCES training_institution (id)');
        $this->addSql('CREATE INDEX IDX_404021BF9736533B ON formation (training_institution_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF9736533B');
        $this->addSql('DROP INDEX IDX_404021BF9736533B ON formation');
        $this->addSql('ALTER TABLE formation CHANGE ended_at ended_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE training_institution_id organization_id INT NOT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF32C8A3DE FOREIGN KEY (organization_id) REFERENCES training_institution (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_404021BF32C8A3DE ON formation (organization_id)');
    }
}
