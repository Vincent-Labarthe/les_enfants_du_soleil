<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725071339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE class_name (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFEA000B10');
        $this->addSql('DROP INDEX IDX_404021BFEA000B10 ON formation');
        $this->addSql('ALTER TABLE formation CHANGE class_id class_name_id INT NOT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFB462FB2A FOREIGN KEY (class_name_id) REFERENCES class_name (id)');
        $this->addSql('CREATE INDEX IDX_404021BFB462FB2A ON formation (class_name_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFB462FB2A');
        $this->addSql('DROP TABLE class_name');
        $this->addSql('DROP INDEX IDX_404021BFB462FB2A ON formation');
        $this->addSql('ALTER TABLE formation CHANGE class_name_id class_id INT NOT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFEA000B10 FOREIGN KEY (class_id) REFERENCES school_level (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_404021BFEA000B10 ON formation (class_id)');
    }
}
