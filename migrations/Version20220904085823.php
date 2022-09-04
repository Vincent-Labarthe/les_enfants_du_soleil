<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220904085823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE training_institution_employee (training_institution_id INT NOT NULL, employee_id INT NOT NULL, INDEX IDX_53093709736533B (training_institution_id), INDEX IDX_53093708C03F15C (employee_id), PRIMARY KEY(training_institution_id, employee_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE training_institution_employee ADD CONSTRAINT FK_53093709736533B FOREIGN KEY (training_institution_id) REFERENCES training_institution (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training_institution_employee ADD CONSTRAINT FK_53093708C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE interview_report DROP FOREIGN KEY FK_A4D67BF3783E3463');
        $this->addSql('ALTER TABLE interview_report ADD CONSTRAINT FK_A4D67BF3783E3463 FOREIGN KEY (manager_id) REFERENCES employee (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE training_institution_employee DROP FOREIGN KEY FK_53093709736533B');
        $this->addSql('ALTER TABLE training_institution_employee DROP FOREIGN KEY FK_53093708C03F15C');
        $this->addSql('DROP TABLE training_institution_employee');
        $this->addSql('ALTER TABLE interview_report DROP FOREIGN KEY FK_A4D67BF3783E3463');
        $this->addSql('ALTER TABLE interview_report ADD CONSTRAINT FK_A4D67BF3783E3463 FOREIGN KEY (manager_id) REFERENCES beneficiary (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
