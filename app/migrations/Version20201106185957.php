<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201106185957 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filter_list (id INT AUTO_INCREMENT NOT NULL, filter VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE setting (id INT AUTO_INCREMENT NOT NULL, setting_key VARCHAR(100) NOT NULL, value LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_9F74B8985FA1E697 (setting_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE twitter_content (id INT AUTO_INCREMENT NOT NULL, filter_id INT DEFAULT NULL, created_at DATETIME NOT NULL, original_id BIGINT NOT NULL, text LONGTEXT NOT NULL, user_screen_name VARCHAR(100) NOT NULL, INDEX IDX_32B4C43BD395B25E (filter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE twitter_max_id (id INT AUTO_INCREMENT NOT NULL, filter_id INT NOT NULL, max_id BIGINT NOT NULL, INDEX IDX_EBF2703FD395B25E (filter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE twitter_content ADD CONSTRAINT FK_32B4C43BD395B25E FOREIGN KEY (filter_id) REFERENCES filter_list (id)');
        $this->addSql('ALTER TABLE twitter_max_id ADD CONSTRAINT FK_EBF2703FD395B25E FOREIGN KEY (filter_id) REFERENCES filter_list (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE twitter_content DROP FOREIGN KEY FK_32B4C43BD395B25E');
        $this->addSql('ALTER TABLE twitter_max_id DROP FOREIGN KEY FK_EBF2703FD395B25E');
        $this->addSql('DROP TABLE filter_list');
        $this->addSql('DROP TABLE setting');
        $this->addSql('DROP TABLE twitter_content');
        $this->addSql('DROP TABLE twitter_max_id');
    }
}
