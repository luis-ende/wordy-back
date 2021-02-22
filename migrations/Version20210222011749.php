<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210222011749 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE expressions_lu (expression_id INT NOT NULL, learning_unit_id INT NOT NULL, PRIMARY KEY(expression_id, learning_unit_id))');
        $this->addSql('CREATE INDEX IDX_51CA4189ADBB65A1 ON expressions_lu (expression_id)');
        $this->addSql('CREATE INDEX IDX_51CA41893C1AC8FE ON expressions_lu (learning_unit_id)');
        $this->addSql('ALTER TABLE expressions_lu ADD CONSTRAINT FK_51CA4189ADBB65A1 FOREIGN KEY (expression_id) REFERENCES expression (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE expressions_lu ADD CONSTRAINT FK_51CA41893C1AC8FE FOREIGN KEY (learning_unit_id) REFERENCES learning_unit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE expression DROP CONSTRAINT fk_d83056013c1ac8fe');
        $this->addSql('DROP INDEX idx_d83056013c1ac8fe');
        $this->addSql('ALTER TABLE expression DROP learning_unit_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE expressions_lu');
        $this->addSql('ALTER TABLE expression ADD learning_unit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE expression ADD CONSTRAINT fk_d83056013c1ac8fe FOREIGN KEY (learning_unit_id) REFERENCES learning_unit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_d83056013c1ac8fe ON expression (learning_unit_id)');
    }
}
