<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210921154921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ingredient_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE model_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE model_ingredient_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE process_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ingredient (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE model (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, price INT NOT NULL, range VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE model_ingredient (id INT NOT NULL, ingredient_id INT DEFAULT NULL, model_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_29073E7933FE08C ON model_ingredient (ingredient_id)');
        $this->addSql('CREATE INDEX IDX_29073E77975B7E7 ON model_ingredient (model_id)');
        $this->addSql('CREATE TABLE process (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, steps JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE model_ingredient ADD CONSTRAINT FK_29073E7933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE model_ingredient ADD CONSTRAINT FK_29073E77975B7E7 FOREIGN KEY (model_id) REFERENCES model (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE model_ingredient DROP CONSTRAINT FK_29073E7933FE08C');
        $this->addSql('ALTER TABLE model_ingredient DROP CONSTRAINT FK_29073E77975B7E7');
        $this->addSql('DROP SEQUENCE ingredient_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE model_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE model_ingredient_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE process_id_seq CASCADE');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE model_ingredient');
        $this->addSql('DROP TABLE process');
    }
}
