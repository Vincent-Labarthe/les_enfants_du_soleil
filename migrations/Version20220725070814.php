<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725070814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aid_type (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE degree (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eds_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school_level (id INT AUTO_INCREMENT NOT NULL, level VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aid ADD aid_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE aid ADD CONSTRAINT FK_48B40DAA286B581 FOREIGN KEY (aid_type_id) REFERENCES aid_type (id)');
        $this->addSql('CREATE INDEX IDX_48B40DAA286B581 ON aid (aid_type_id)');
        $this->addSql('ALTER TABLE eds_entity ADD eds_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE eds_entity ADD CONSTRAINT FK_9D639D0C8F00620B FOREIGN KEY (eds_type_id) REFERENCES eds_type (id)');
        $this->addSql('CREATE INDEX IDX_9D639D0C8F00620B ON eds_entity (eds_type_id)');
        $this->addSql('ALTER TABLE formation ADD class_id INT NOT NULL, DROP level, DROP class');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFEA000B10 FOREIGN KEY (class_id) REFERENCES school_level (id)');
        $this->addSql('CREATE INDEX IDX_404021BFEA000B10 ON formation (class_id)');
        $this->addSql('ALTER TABLE health_event ADD reason VARCHAR(255) NOT NULL, ADD diagnosis VARCHAR(255) DEFAULT NULL, ADD analysis VARCHAR(255) DEFAULT NULL, ADD imagery VARCHAR(255) DEFAULT NULL, ADD treatment VARCHAR(255) DEFAULT NULL, ADD comment VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE medical_event DROP reason, DROP diagnosis, DROP analysis, DROP imagery, DROP treatment, DROP comment');
        $this->addSql('ALTER TABLE person ADD school_level_id INT DEFAULT NULL, ADD degree_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176A1F77FE3 FOREIGN KEY (school_level_id) REFERENCES school_level (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176B35C5756 FOREIGN KEY (degree_id) REFERENCES degree (id)');
        $this->addSql('CREATE INDEX IDX_34DCD176A1F77FE3 ON person (school_level_id)');
        $this->addSql('CREATE INDEX IDX_34DCD176B35C5756 ON person (degree_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aid DROP FOREIGN KEY FK_48B40DAA286B581');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176B35C5756');
        $this->addSql('ALTER TABLE eds_entity DROP FOREIGN KEY FK_9D639D0C8F00620B');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFEA000B10');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176A1F77FE3');
        $this->addSql('DROP TABLE aid_type');
        $this->addSql('DROP TABLE degree');
        $this->addSql('DROP TABLE eds_type');
        $this->addSql('DROP TABLE school_level');
        $this->addSql('DROP INDEX IDX_48B40DAA286B581 ON aid');
        $this->addSql('ALTER TABLE aid DROP aid_type_id');
        $this->addSql('DROP INDEX IDX_9D639D0C8F00620B ON eds_entity');
        $this->addSql('ALTER TABLE eds_entity DROP eds_type_id');
        $this->addSql('DROP INDEX IDX_404021BFEA000B10 ON formation');
        $this->addSql('ALTER TABLE formation ADD level VARCHAR(255) NOT NULL, ADD class VARCHAR(255) NOT NULL, DROP class_id');
        $this->addSql('ALTER TABLE health_event DROP reason, DROP diagnosis, DROP analysis, DROP imagery, DROP treatment, DROP comment');
        $this->addSql('ALTER TABLE medical_event ADD reason VARCHAR(255) NOT NULL, ADD diagnosis VARCHAR(255) DEFAULT NULL, ADD analysis VARCHAR(255) DEFAULT NULL, ADD imagery VARCHAR(255) DEFAULT NULL, ADD treatment VARCHAR(255) DEFAULT NULL, ADD comment VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_34DCD176A1F77FE3 ON person');
        $this->addSql('DROP INDEX IDX_34DCD176B35C5756 ON person');
        $this->addSql('ALTER TABLE person DROP school_level_id, DROP degree_id');
    }
}
