<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210221183756 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE expression_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE learning_unit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE expression (id INT NOT NULL, learning_unit_id INT DEFAULT NULL, text_language1 TEXT NOT NULL, text_language2 TEXT NOT NULL, language1 SMALLINT NOT NULL, language2 SMALLINT NOT NULL, grammar_type SMALLINT DEFAULT NULL, is_learning BOOLEAN NOT NULL, learning_updated DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D83056013C1AC8FE ON expression (learning_unit_id)');
        $this->addSql('CREATE TABLE learning_unit (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE expression ADD CONSTRAINT FK_D83056013C1AC8FE FOREIGN KEY (learning_unit_id) REFERENCES learning_unit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE expression DROP CONSTRAINT FK_D83056013C1AC8FE');
        $this->addSql('DROP SEQUENCE expression_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE learning_unit_id_seq CASCADE');
        $this->addSql('DROP TABLE expression');
        $this->addSql('DROP TABLE learning_unit');
    }
}
