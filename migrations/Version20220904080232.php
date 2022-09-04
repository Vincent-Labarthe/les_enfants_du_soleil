<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220904080232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aid DROP FOREIGN KEY FK_48B40DAA217BBB47');
        $this->addSql('DROP INDEX IDX_48B40DAA217BBB47 ON aid');
        $this->addSql('ALTER TABLE aid CHANGE person_id beneficiary_id INT NOT NULL');
        $this->addSql('ALTER TABLE aid ADD CONSTRAINT FK_48B40DAAECCAAFA0 FOREIGN KEY (beneficiary_id) REFERENCES beneficiary (id)');
        $this->addSql('CREATE INDEX IDX_48B40DAAECCAAFA0 ON aid (beneficiary_id)');
        $this->addSql('ALTER TABLE behavior_event DROP FOREIGN KEY FK_692FFEAD217BBB47');
        $this->addSql('DROP INDEX IDX_692FFEAD217BBB47 ON behavior_event');
        $this->addSql('ALTER TABLE behavior_event CHANGE person_id beneficiary_id INT NOT NULL');
        $this->addSql('ALTER TABLE behavior_event ADD CONSTRAINT FK_692FFEADECCAAFA0 FOREIGN KEY (beneficiary_id) REFERENCES beneficiary (id)');
        $this->addSql('CREATE INDEX IDX_692FFEADECCAAFA0 ON behavior_event (beneficiary_id)');
        $this->addSql('ALTER TABLE health_event DROP FOREIGN KEY FK_606D216D217BBB47');
        $this->addSql('DROP INDEX IDX_606D216D217BBB47 ON health_event');
        $this->addSql('ALTER TABLE health_event CHANGE person_id beneficiary_id INT NOT NULL');
        $this->addSql('ALTER TABLE health_event ADD CONSTRAINT FK_606D216DECCAAFA0 FOREIGN KEY (beneficiary_id) REFERENCES beneficiary (id)');
        $this->addSql('CREATE INDEX IDX_606D216DECCAAFA0 ON health_event (beneficiary_id)');
        $this->addSql('ALTER TABLE interview_report DROP FOREIGN KEY FK_A4D67BF3217BBB47');
        $this->addSql('DROP INDEX IDX_A4D67BF3217BBB47 ON interview_report');
        $this->addSql('ALTER TABLE interview_report CHANGE person_id beneficiary_id INT NOT NULL');
        $this->addSql('ALTER TABLE interview_report ADD CONSTRAINT FK_A4D67BF3ECCAAFA0 FOREIGN KEY (beneficiary_id) REFERENCES beneficiary (id)');
        $this->addSql('CREATE INDEX IDX_A4D67BF3ECCAAFA0 ON interview_report (beneficiary_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aid DROP FOREIGN KEY FK_48B40DAAECCAAFA0');
        $this->addSql('DROP INDEX IDX_48B40DAAECCAAFA0 ON aid');
        $this->addSql('ALTER TABLE aid CHANGE beneficiary_id person_id INT NOT NULL');
        $this->addSql('ALTER TABLE aid ADD CONSTRAINT FK_48B40DAA217BBB47 FOREIGN KEY (person_id) REFERENCES beneficiary (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_48B40DAA217BBB47 ON aid (person_id)');
        $this->addSql('ALTER TABLE behavior_event DROP FOREIGN KEY FK_692FFEADECCAAFA0');
        $this->addSql('DROP INDEX IDX_692FFEADECCAAFA0 ON behavior_event');
        $this->addSql('ALTER TABLE behavior_event CHANGE beneficiary_id person_id INT NOT NULL');
        $this->addSql('ALTER TABLE behavior_event ADD CONSTRAINT FK_692FFEAD217BBB47 FOREIGN KEY (person_id) REFERENCES beneficiary (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_692FFEAD217BBB47 ON behavior_event (person_id)');
        $this->addSql('ALTER TABLE health_event DROP FOREIGN KEY FK_606D216DECCAAFA0');
        $this->addSql('DROP INDEX IDX_606D216DECCAAFA0 ON health_event');
        $this->addSql('ALTER TABLE health_event CHANGE beneficiary_id person_id INT NOT NULL');
        $this->addSql('ALTER TABLE health_event ADD CONSTRAINT FK_606D216D217BBB47 FOREIGN KEY (person_id) REFERENCES beneficiary (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_606D216D217BBB47 ON health_event (person_id)');
        $this->addSql('ALTER TABLE interview_report DROP FOREIGN KEY FK_A4D67BF3ECCAAFA0');
        $this->addSql('DROP INDEX IDX_A4D67BF3ECCAAFA0 ON interview_report');
        $this->addSql('ALTER TABLE interview_report CHANGE beneficiary_id person_id INT NOT NULL');
        $this->addSql('ALTER TABLE interview_report ADD CONSTRAINT FK_A4D67BF3217BBB47 FOREIGN KEY (person_id) REFERENCES beneficiary (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A4D67BF3217BBB47 ON interview_report (person_id)');
    }
}
