<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725142159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE interview_report ADD person_id INT NOT NULL');
        $this->addSql('ALTER TABLE interview_report ADD CONSTRAINT FK_A4D67BF3217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_A4D67BF3217BBB47 ON interview_report (person_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE interview_report DROP FOREIGN KEY FK_A4D67BF3217BBB47');
        $this->addSql('DROP INDEX IDX_A4D67BF3217BBB47 ON interview_report');
        $this->addSql('ALTER TABLE interview_report DROP person_id');
    }
}
