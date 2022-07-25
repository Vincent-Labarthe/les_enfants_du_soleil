<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725140404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF217BBB47');
        $this->addSql('DROP INDEX IDX_404021BF217BBB47 ON formation');
        $this->addSql('ALTER TABLE formation DROP person_id');
        $this->addSql('ALTER TABLE person ADD followed_formation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD17683E3CBB1 FOREIGN KEY (followed_formation_id) REFERENCES formation (id)');
        $this->addSql('CREATE INDEX IDX_34DCD17683E3CBB1 ON person (followed_formation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation ADD person_id INT NOT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_404021BF217BBB47 ON formation (person_id)');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD17683E3CBB1');
        $this->addSql('DROP INDEX IDX_34DCD17683E3CBB1 ON person');
        $this->addSql('ALTER TABLE person DROP followed_formation_id');
    }
}
