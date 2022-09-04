<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220904075455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(255) NOT NULL, zip VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aid (id INT AUTO_INCREMENT NOT NULL, person_id INT NOT NULL, aid_type_id INT NOT NULL, ended_at DATETIME DEFAULT NULL, annual_amount INT DEFAULT NULL, started_at DATETIME NOT NULL, INDEX IDX_48B40DAA217BBB47 (person_id), INDEX IDX_48B40DAA286B581 (aid_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aid_type (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE behavior_event (id INT AUTO_INCREMENT NOT NULL, person_id INT NOT NULL, event_behavior_type_id INT NOT NULL, comment VARCHAR(255) NOT NULL, INDEX IDX_692FFEAD217BBB47 (person_id), INDEX IDX_692FFEADA363E355 (event_behavior_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE beneficiary (id INT AUTO_INCREMENT NOT NULL, origin_id INT NOT NULL, school_level_id INT DEFAULT NULL, degree_id INT DEFAULT NULL, eds_manage_id INT DEFAULT NULL, correspondant_training_institution_id INT DEFAULT NULL, training_institution_id INT DEFAULT NULL, eds_entity_id INT DEFAULT NULL, sexe VARCHAR(255) NOT NULL, date_of_birth DATE DEFAULT NULL, family_relation VARCHAR(255) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, support_started_at DATETIME DEFAULT NULL, support_ended_at DATETIME DEFAULT NULL, tel VARCHAR(255) DEFAULT NULL, INDEX IDX_7ABF446A56A273CC (origin_id), INDEX IDX_7ABF446AA1F77FE3 (school_level_id), INDEX IDX_7ABF446AB35C5756 (degree_id), INDEX IDX_7ABF446AF850C50 (eds_manage_id), UNIQUE INDEX UNIQ_7ABF446A17EEA388 (correspondant_training_institution_id), INDEX IDX_7ABF446A9736533B (training_institution_id), INDEX IDX_7ABF446A7F0FF87C (eds_entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE beneficiary_sponsorship (beneficiary_id INT NOT NULL, sponsorship_id INT NOT NULL, INDEX IDX_20C8C9D1ECCAAFA0 (beneficiary_id), INDEX IDX_20C8C9D18ACED59A (sponsorship_id), PRIMARY KEY(beneficiary_id, sponsorship_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE class_name (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, address_id INT NOT NULL, correspondent_id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, comment VARCHAR(255) DEFAULT NULL, activity VARCHAR(255) NOT NULL, INDEX IDX_4FBF094FF5B7AF75 (address_id), UNIQUE INDEX UNIQ_4FBF094F2071082D (correspondent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE degree (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eds_entity (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, eds_parent_id INT DEFAULT NULL, eds_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_9D639D0CF5B7AF75 (address_id), INDEX IDX_9D639D0C8C504F51 (eds_parent_id), INDEX IDX_9D639D0C8F00620B (eds_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eds_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_behavior_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_medical_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, training_institution_id INT NOT NULL, class_name_id INT NOT NULL, student_id INT NOT NULL, specialty VARCHAR(255) NOT NULL, result VARCHAR(255) DEFAULT NULL, suggested_direction VARCHAR(255) DEFAULT NULL, ended_at DATETIME DEFAULT NULL, started_at DATETIME NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_404021BF9736533B (training_institution_id), INDEX IDX_404021BFB462FB2A (class_name_id), UNIQUE INDEX UNIQ_404021BFCB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE general_identifier (id INT AUTO_INCREMENT NOT NULL, beneficiary_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_411A1FBE7927C74 (email), UNIQUE INDEX UNIQ_411A1FBECCAAFA0 (beneficiary_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE health_event (id INT AUTO_INCREMENT NOT NULL, person_id INT NOT NULL, event_medical_type_id INT NOT NULL, is_disease TINYINT(1) NOT NULL, reason VARCHAR(255) NOT NULL, diagnosis VARCHAR(255) DEFAULT NULL, analysis VARCHAR(255) DEFAULT NULL, imagery VARCHAR(255) DEFAULT NULL, treatment VARCHAR(255) DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, consultation_cost NUMERIC(10, 0) DEFAULT NULL, drugs_cost NUMERIC(10, 0) DEFAULT NULL, other_cost NUMERIC(10, 0) DEFAULT NULL, INDEX IDX_606D216D217BBB47 (person_id), INDEX IDX_606D216D4A9D086D (event_medical_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interview_report (id INT AUTO_INCREMENT NOT NULL, person_id INT NOT NULL, manager_id INT NOT NULL, report VARCHAR(255) NOT NULL, INDEX IDX_A4D67BF3217BBB47 (person_id), INDEX IDX_A4D67BF3783E3463 (manager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, beneficiary_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, ended_at DATETIME DEFAULT NULL, annual_salary INT NOT NULL, started_at DATETIME NOT NULL, INDEX IDX_FBD8E0F8979B1AD6 (company_id), INDEX IDX_FBD8E0F8ECCAAFA0 (beneficiary_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE origin (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school_level (id INT AUTO_INCREMENT NOT NULL, level VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sponsorship (id INT AUTO_INCREMENT NOT NULL, sponsor_id INT NOT NULL, ended_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', annual_amount INT DEFAULT NULL, pace_of_cr VARCHAR(255) DEFAULT NULL, INDEX IDX_C0F10CD412F7FB51 (sponsor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_institution (id INT AUTO_INCREMENT NOT NULL, address_id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, speciality VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, comment VARCHAR(255) DEFAULT NULL, INDEX IDX_9EF4E232F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aid ADD CONSTRAINT FK_48B40DAA217BBB47 FOREIGN KEY (person_id) REFERENCES beneficiary (id)');
        $this->addSql('ALTER TABLE aid ADD CONSTRAINT FK_48B40DAA286B581 FOREIGN KEY (aid_type_id) REFERENCES aid_type (id)');
        $this->addSql('ALTER TABLE behavior_event ADD CONSTRAINT FK_692FFEAD217BBB47 FOREIGN KEY (person_id) REFERENCES beneficiary (id)');
        $this->addSql('ALTER TABLE behavior_event ADD CONSTRAINT FK_692FFEADA363E355 FOREIGN KEY (event_behavior_type_id) REFERENCES event_behavior_type (id)');
        $this->addSql('ALTER TABLE beneficiary ADD CONSTRAINT FK_7ABF446A56A273CC FOREIGN KEY (origin_id) REFERENCES origin (id)');
        $this->addSql('ALTER TABLE beneficiary ADD CONSTRAINT FK_7ABF446AA1F77FE3 FOREIGN KEY (school_level_id) REFERENCES school_level (id)');
        $this->addSql('ALTER TABLE beneficiary ADD CONSTRAINT FK_7ABF446AB35C5756 FOREIGN KEY (degree_id) REFERENCES degree (id)');
        $this->addSql('ALTER TABLE beneficiary ADD CONSTRAINT FK_7ABF446AF850C50 FOREIGN KEY (eds_manage_id) REFERENCES eds_entity (id)');
        $this->addSql('ALTER TABLE beneficiary ADD CONSTRAINT FK_7ABF446A17EEA388 FOREIGN KEY (correspondant_training_institution_id) REFERENCES training_institution (id)');
        $this->addSql('ALTER TABLE beneficiary ADD CONSTRAINT FK_7ABF446A9736533B FOREIGN KEY (training_institution_id) REFERENCES training_institution (id)');
        $this->addSql('ALTER TABLE beneficiary ADD CONSTRAINT FK_7ABF446A7F0FF87C FOREIGN KEY (eds_entity_id) REFERENCES eds_entity (id)');
        $this->addSql('ALTER TABLE beneficiary_sponsorship ADD CONSTRAINT FK_20C8C9D1ECCAAFA0 FOREIGN KEY (beneficiary_id) REFERENCES beneficiary (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE beneficiary_sponsorship ADD CONSTRAINT FK_20C8C9D18ACED59A FOREIGN KEY (sponsorship_id) REFERENCES sponsorship (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F2071082D FOREIGN KEY (correspondent_id) REFERENCES beneficiary (id)');
        $this->addSql('ALTER TABLE eds_entity ADD CONSTRAINT FK_9D639D0CF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE eds_entity ADD CONSTRAINT FK_9D639D0C8C504F51 FOREIGN KEY (eds_parent_id) REFERENCES eds_entity (id)');
        $this->addSql('ALTER TABLE eds_entity ADD CONSTRAINT FK_9D639D0C8F00620B FOREIGN KEY (eds_type_id) REFERENCES eds_type (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF9736533B FOREIGN KEY (training_institution_id) REFERENCES training_institution (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFB462FB2A FOREIGN KEY (class_name_id) REFERENCES class_name (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFCB944F1A FOREIGN KEY (student_id) REFERENCES beneficiary (id)');
        $this->addSql('ALTER TABLE general_identifier ADD CONSTRAINT FK_411A1FBECCAAFA0 FOREIGN KEY (beneficiary_id) REFERENCES beneficiary (id)');
        $this->addSql('ALTER TABLE health_event ADD CONSTRAINT FK_606D216D217BBB47 FOREIGN KEY (person_id) REFERENCES beneficiary (id)');
        $this->addSql('ALTER TABLE health_event ADD CONSTRAINT FK_606D216D4A9D086D FOREIGN KEY (event_medical_type_id) REFERENCES event_medical_type (id)');
        $this->addSql('ALTER TABLE interview_report ADD CONSTRAINT FK_A4D67BF3217BBB47 FOREIGN KEY (person_id) REFERENCES beneficiary (id)');
        $this->addSql('ALTER TABLE interview_report ADD CONSTRAINT FK_A4D67BF3783E3463 FOREIGN KEY (manager_id) REFERENCES beneficiary (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8ECCAAFA0 FOREIGN KEY (beneficiary_id) REFERENCES beneficiary (id)');
        $this->addSql('ALTER TABLE sponsorship ADD CONSTRAINT FK_C0F10CD412F7FB51 FOREIGN KEY (sponsor_id) REFERENCES beneficiary (id)');
        $this->addSql('ALTER TABLE training_institution ADD CONSTRAINT FK_9EF4E232F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aid DROP FOREIGN KEY FK_48B40DAA217BBB47');
        $this->addSql('ALTER TABLE aid DROP FOREIGN KEY FK_48B40DAA286B581');
        $this->addSql('ALTER TABLE behavior_event DROP FOREIGN KEY FK_692FFEAD217BBB47');
        $this->addSql('ALTER TABLE behavior_event DROP FOREIGN KEY FK_692FFEADA363E355');
        $this->addSql('ALTER TABLE beneficiary DROP FOREIGN KEY FK_7ABF446A56A273CC');
        $this->addSql('ALTER TABLE beneficiary DROP FOREIGN KEY FK_7ABF446AA1F77FE3');
        $this->addSql('ALTER TABLE beneficiary DROP FOREIGN KEY FK_7ABF446AB35C5756');
        $this->addSql('ALTER TABLE beneficiary DROP FOREIGN KEY FK_7ABF446AF850C50');
        $this->addSql('ALTER TABLE beneficiary DROP FOREIGN KEY FK_7ABF446A17EEA388');
        $this->addSql('ALTER TABLE beneficiary DROP FOREIGN KEY FK_7ABF446A9736533B');
        $this->addSql('ALTER TABLE beneficiary DROP FOREIGN KEY FK_7ABF446A7F0FF87C');
        $this->addSql('ALTER TABLE beneficiary_sponsorship DROP FOREIGN KEY FK_20C8C9D1ECCAAFA0');
        $this->addSql('ALTER TABLE beneficiary_sponsorship DROP FOREIGN KEY FK_20C8C9D18ACED59A');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FF5B7AF75');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F2071082D');
        $this->addSql('ALTER TABLE eds_entity DROP FOREIGN KEY FK_9D639D0CF5B7AF75');
        $this->addSql('ALTER TABLE eds_entity DROP FOREIGN KEY FK_9D639D0C8C504F51');
        $this->addSql('ALTER TABLE eds_entity DROP FOREIGN KEY FK_9D639D0C8F00620B');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF9736533B');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFB462FB2A');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFCB944F1A');
        $this->addSql('ALTER TABLE general_identifier DROP FOREIGN KEY FK_411A1FBECCAAFA0');
        $this->addSql('ALTER TABLE health_event DROP FOREIGN KEY FK_606D216D217BBB47');
        $this->addSql('ALTER TABLE health_event DROP FOREIGN KEY FK_606D216D4A9D086D');
        $this->addSql('ALTER TABLE interview_report DROP FOREIGN KEY FK_A4D67BF3217BBB47');
        $this->addSql('ALTER TABLE interview_report DROP FOREIGN KEY FK_A4D67BF3783E3463');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8979B1AD6');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8ECCAAFA0');
        $this->addSql('ALTER TABLE sponsorship DROP FOREIGN KEY FK_C0F10CD412F7FB51');
        $this->addSql('ALTER TABLE training_institution DROP FOREIGN KEY FK_9EF4E232F5B7AF75');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE aid');
        $this->addSql('DROP TABLE aid_type');
        $this->addSql('DROP TABLE behavior_event');
        $this->addSql('DROP TABLE beneficiary');
        $this->addSql('DROP TABLE beneficiary_sponsorship');
        $this->addSql('DROP TABLE class_name');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE degree');
        $this->addSql('DROP TABLE eds_entity');
        $this->addSql('DROP TABLE eds_type');
        $this->addSql('DROP TABLE event_behavior_type');
        $this->addSql('DROP TABLE event_medical_type');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE general_identifier');
        $this->addSql('DROP TABLE health_event');
        $this->addSql('DROP TABLE interview_report');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE origin');
        $this->addSql('DROP TABLE school_level');
        $this->addSql('DROP TABLE sponsorship');
        $this->addSql('DROP TABLE training_institution');
        $this->addSql('DROP TABLE user');
    }
}
