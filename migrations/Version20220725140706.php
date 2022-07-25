<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725140706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person DROP INDEX IDX_34DCD17683E3CBB1, ADD UNIQUE INDEX UNIQ_34DCD17683E3CBB1 (followed_formation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person DROP INDEX UNIQ_34DCD17683E3CBB1, ADD INDEX IDX_34DCD17683E3CBB1 (followed_formation_id)');
    }
}
