<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725065642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176B35C5756');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF14463F54');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176A1F77FE3');
        $this->addSql('DROP TABLE degree');
        $this->addSql('DROP TABLE organization');
        $this->addSql('DROP TABLE person_job');
        $this->addSql('DROP TABLE school_class');
        $this->addSql('DROP TABLE school_level');
        $this->addSql('ALTER TABLE eds_entity DROP FOREIGN KEY FK_9D639D0CA8FC14C5');
        $this->addSql('DROP INDEX IDX_9D639D0CA8FC14C5 ON eds_entity');
        $this->addSql('ALTER TABLE eds_entity CHANGE eds_linked_id eds_parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eds_entity ADD CONSTRAINT FK_9D639D0C8C504F51 FOREIGN KEY (eds_parent_id) REFERENCES eds_entity (id)');
        $this->addSql('CREATE INDEX IDX_9D639D0C8C504F51 ON eds_entity (eds_parent_id)');
        $this->addSql('DROP INDEX IDX_404021BF14463F54 ON formation');
        $this->addSql('ALTER TABLE formation ADD level VARCHAR(255) NOT NULL, ADD class VARCHAR(255) NOT NULL, ADD started_at DATETIME NOT NULL, DROP school_class_id');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF32C8A3DE FOREIGN KEY (organization_id) REFERENCES training_institution (id)');
        $this->addSql('ALTER TABLE location CHANGE location_started_at location_started_at DATETIME NOT NULL, CHANGE location_ended_at location_ended_at DATETIME DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_34DCD176A1F77FE3 ON person');
        $this->addSql('DROP INDEX IDX_34DCD176B35C5756 ON person');
        $this->addSql('ALTER TABLE person DROP degree_id, DROP current_site_attachment, CHANGE support_started_at support_started_at DATETIME NOT NULL, CHANGE support_ended_at support_ended_at DATETIME DEFAULT NULL, CHANGE school_level_id origin_id INT NOT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD17656A273CC FOREIGN KEY (origin_id) REFERENCES origin (id)');
        $this->addSql('CREATE INDEX IDX_34DCD17656A273CC ON person (origin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE degree (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE organization (id INT AUTO_INCREMENT NOT NULL, address_id INT NOT NULL, correspondent_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, specialty VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, tel VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, comment VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_C1EE637CF5B7AF75 (address_id), UNIQUE INDEX UNIQ_C1EE637C2071082D (correspondent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE person_job (person_id INT NOT NULL, job_id INT NOT NULL, INDEX IDX_789527E3217BBB47 (person_id), INDEX IDX_789527E3BE04EA9 (job_id), PRIMARY KEY(person_id, job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE school_class (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE school_level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE organization ADD CONSTRAINT FK_C1EE637C2071082D FOREIGN KEY (correspondent_id) REFERENCES person (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE organization ADD CONSTRAINT FK_C1EE637CF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE person_job ADD CONSTRAINT FK_789527E3217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person_job ADD CONSTRAINT FK_789527E3BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eds_entity DROP FOREIGN KEY FK_9D639D0C8C504F51');
        $this->addSql('DROP INDEX IDX_9D639D0C8C504F51 ON eds_entity');
        $this->addSql('ALTER TABLE eds_entity CHANGE eds_parent_id eds_linked_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eds_entity ADD CONSTRAINT FK_9D639D0CA8FC14C5 FOREIGN KEY (eds_linked_id) REFERENCES eds_entity (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9D639D0CA8FC14C5 ON eds_entity (eds_linked_id)');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF32C8A3DE');
        $this->addSql('ALTER TABLE formation ADD school_class_id INT NOT NULL, DROP level, DROP class, DROP started_at');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF14463F54 FOREIGN KEY (school_class_id) REFERENCES school_class (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_404021BF14463F54 ON formation (school_class_id)');
        $this->addSql('ALTER TABLE location CHANGE location_started_at location_started_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE location_ended_at location_ended_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD17656A273CC');
        $this->addSql('DROP INDEX IDX_34DCD17656A273CC ON person');
        $this->addSql('ALTER TABLE person ADD degree_id INT DEFAULT NULL, ADD current_site_attachment VARCHAR(255) DEFAULT NULL, CHANGE support_started_at support_started_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE support_ended_at support_ended_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE origin_id school_level_id INT NOT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176A1F77FE3 FOREIGN KEY (school_level_id) REFERENCES school_level (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176B35C5756 FOREIGN KEY (degree_id) REFERENCES degree (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_34DCD176A1F77FE3 ON person (school_level_id)');
        $this->addSql('CREATE INDEX IDX_34DCD176B35C5756 ON person (degree_id)');
    }
}
