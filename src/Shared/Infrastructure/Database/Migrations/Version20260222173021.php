<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260222173021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create identity schema and users table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA identity');
        $this->addSql('CREATE TABLE identity.users (email VARCHAR(180) NOT NULL, password VARCHAR(255) DEFAULT NULL, roles JSON DEFAULT \'["ROLE_USER"]\' NOT NULL, id UUID NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3EA6317DE7927C74 ON identity.users (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE identity.users');
        $this->addSql('DROP SCHEMA identity');
    }
}
