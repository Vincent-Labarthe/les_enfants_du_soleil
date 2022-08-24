<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725140822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation ADD student_id INT NOT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFCB944F1A FOREIGN KEY (student_id) REFERENCES person (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_404021BFCB944F1A ON formation (student_id)');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD17683E3CBB1');
        $this->addSql('DROP INDEX UNIQ_34DCD17683E3CBB1 ON person');
        $this->addSql('ALTER TABLE person DROP followed_formation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFCB944F1A');
        $this->addSql('DROP INDEX UNIQ_404021BFCB944F1A ON formation');
        $this->addSql('ALTER TABLE formation DROP student_id');
        $this->addSql('ALTER TABLE person ADD followed_formation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD17683E3CBB1 FOREIGN KEY (followed_formation_id) REFERENCES formation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34DCD17683E3CBB1 ON person (followed_formation_id)');
    }
}
