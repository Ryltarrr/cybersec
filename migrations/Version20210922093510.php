<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210922093510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE model ADD process_id INT NOT NULL');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D97EC2F574 FOREIGN KEY (process_id) REFERENCES process (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D79572D97EC2F574 ON model (process_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE model DROP CONSTRAINT FK_D79572D97EC2F574');
        $this->addSql('DROP INDEX IDX_D79572D97EC2F574');
        $this->addSql('ALTER TABLE model DROP process_id');
    }
}
