<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220906153003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE general_identifier ADD employee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE general_identifier ADD CONSTRAINT FK_411A1FB8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_411A1FB8C03F15C ON general_identifier (employee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE general_identifier DROP FOREIGN KEY FK_411A1FB8C03F15C');
        $this->addSql('DROP INDEX UNIQ_411A1FB8C03F15C ON general_identifier');
        $this->addSql('ALTER TABLE general_identifier DROP employee_id');
    }
}
