<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170621073355 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE video (video_id SERIAL NOT NULL, speech_id INT DEFAULT NULL, original_name VARCHAR(255) NOT NULL, mime_type VARCHAR(50) NOT NULL, path_name VARCHAR(255) NOT NULL, file_name VARCHAR(255) NOT NULL, file_size BIGINT NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modifiedAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(video_id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7CC7DA2CBBC049D6 ON video (speech_id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CBBC049D6 FOREIGN KEY (speech_id) REFERENCES speech (speech_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE video');
    }
}
