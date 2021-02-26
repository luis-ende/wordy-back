<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210226000634 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE example ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('UPDATE example SET created_at = NOW()');
        $this->addSql('ALTER TABLE example ALTER COLUMN created_at SET NOT NULL');
        $this->addSql('ALTER TABLE expression ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('UPDATE expression SET created_at = NOW()');
        $this->addSql('ALTER TABLE expression ALTER COLUMN created_at SET NOT NULL');
        $this->addSql('ALTER TABLE learning_unit ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('UPDATE learning_unit SET created_at = NOW()');
        $this->addSql('ALTER TABLE learning_unit ALTER COLUMN created_at SET NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE learning_unit DROP created_at');
        $this->addSql('ALTER TABLE expression DROP created_at');
        $this->addSql('ALTER TABLE example DROP created_at');
    }
}
