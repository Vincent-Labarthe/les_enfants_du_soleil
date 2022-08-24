<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725134857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person ADD correspondant_training_institution_id INT DEFAULT NULL, ADD training_institution_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD17617EEA388 FOREIGN KEY (correspondant_training_institution_id) REFERENCES training_institution (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD1769736533B FOREIGN KEY (training_institution_id) REFERENCES training_institution (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34DCD17617EEA388 ON person (correspondant_training_institution_id)');
        $this->addSql('CREATE INDEX IDX_34DCD1769736533B ON person (training_institution_id)');
        $this->addSql('ALTER TABLE training_institution DROP FOREIGN KEY FK_9EF4E2322071082D');
        $this->addSql('DROP INDEX UNIQ_9EF4E2322071082D ON training_institution');
        $this->addSql('ALTER TABLE training_institution DROP correspondent_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD17617EEA388');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD1769736533B');
        $this->addSql('DROP INDEX UNIQ_34DCD17617EEA388 ON person');
        $this->addSql('DROP INDEX IDX_34DCD1769736533B ON person');
        $this->addSql('ALTER TABLE person DROP correspondant_training_institution_id, DROP training_institution_id');
        $this->addSql('ALTER TABLE training_institution ADD correspondent_id INT NOT NULL');
        $this->addSql('ALTER TABLE training_institution ADD CONSTRAINT FK_9EF4E2322071082D FOREIGN KEY (correspondent_id) REFERENCES person (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9EF4E2322071082D ON training_institution (correspondent_id)');
    }
}
