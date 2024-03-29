<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220909124129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE beneficiary ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7ABF446AE7927C74 ON beneficiary (email)');
        $this->addSql('DROP INDEX UNIQ_411A1FBE7927C74 ON general_identifier');
        $this->addSql('ALTER TABLE general_identifier DROP firstname, DROP lastname, DROP email');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_7ABF446AE7927C74 ON beneficiary');
        $this->addSql('ALTER TABLE beneficiary DROP first_name, DROP last_name, DROP email');
        $this->addSql('ALTER TABLE general_identifier ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_411A1FBE7927C74 ON general_identifier (email)');
    }
}
