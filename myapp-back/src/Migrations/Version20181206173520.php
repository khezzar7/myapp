<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181206173520 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE loaning ADD media_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE loaning ADD CONSTRAINT FK_38DDD8D0EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('CREATE INDEX IDX_38DDD8D0EA9FDD75 ON loaning (media_id)');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C5A4B1146');
        $this->addSql('DROP INDEX IDX_6A2CA10C5A4B1146 ON media');
        $this->addSql('ALTER TABLE media DROP loaning_id, DROP author');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE loaning DROP FOREIGN KEY FK_38DDD8D0EA9FDD75');
        $this->addSql('DROP INDEX IDX_38DDD8D0EA9FDD75 ON loaning');
        $this->addSql('ALTER TABLE loaning DROP media_id');
        $this->addSql('ALTER TABLE media ADD loaning_id INT DEFAULT NULL, ADD author VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C5A4B1146 FOREIGN KEY (loaning_id) REFERENCES loaning (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C5A4B1146 ON media (loaning_id)');
    }
}
