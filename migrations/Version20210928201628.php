<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210928201628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE model DROP CONSTRAINT FK_D79572D97EC2F574');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D97EC2F574 FOREIGN KEY (process_id) REFERENCES process (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE model DROP CONSTRAINT fk_d79572d97ec2f574');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT fk_d79572d97ec2f574 FOREIGN KEY (process_id) REFERENCES process (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
