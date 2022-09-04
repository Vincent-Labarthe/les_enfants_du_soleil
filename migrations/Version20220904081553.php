<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220904081553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, image_url VARCHAR(255) DEFAULT NULL, tel VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_eds_entity (employee_id INT NOT NULL, eds_entity_id INT NOT NULL, INDEX IDX_5B42DD88C03F15C (employee_id), INDEX IDX_5B42DD87F0FF87C (eds_entity_id), PRIMARY KEY(employee_id, eds_entity_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employee_eds_entity ADD CONSTRAINT FK_5B42DD88C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_eds_entity ADD CONSTRAINT FK_5B42DD87F0FF87C FOREIGN KEY (eds_entity_id) REFERENCES eds_entity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE beneficiary DROP FOREIGN KEY FK_7ABF446AF850C50');
        $this->addSql('ALTER TABLE beneficiary DROP FOREIGN KEY FK_7ABF446A17EEA388');
        $this->addSql('DROP INDEX IDX_7ABF446AF850C50 ON beneficiary');
        $this->addSql('DROP INDEX UNIQ_7ABF446A17EEA388 ON beneficiary');
        $this->addSql('ALTER TABLE beneficiary DROP eds_manage_id, DROP correspondant_training_institution_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee_eds_entity DROP FOREIGN KEY FK_5B42DD88C03F15C');
        $this->addSql('ALTER TABLE employee_eds_entity DROP FOREIGN KEY FK_5B42DD87F0FF87C');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE employee_eds_entity');
        $this->addSql('ALTER TABLE beneficiary ADD eds_manage_id INT DEFAULT NULL, ADD correspondant_training_institution_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE beneficiary ADD CONSTRAINT FK_7ABF446AF850C50 FOREIGN KEY (eds_manage_id) REFERENCES eds_entity (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE beneficiary ADD CONSTRAINT FK_7ABF446A17EEA388 FOREIGN KEY (correspondant_training_institution_id) REFERENCES training_institution (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7ABF446AF850C50 ON beneficiary (eds_manage_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7ABF446A17EEA388 ON beneficiary (correspondant_training_institution_id)');
    }
}
