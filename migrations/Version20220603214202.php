<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220603214202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE group_genre (group_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_D37C189FFE54D947 (group_id), INDEX IDX_D37C189F4296D31F (genre_id), PRIMARY KEY(group_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE group_genre ADD CONSTRAINT FK_D37C189FFE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_genre ADD CONSTRAINT FK_D37C189F4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C54296D31F');
        $this->addSql('DROP INDEX IDX_6DC044C54296D31F ON `group`');
        $this->addSql('ALTER TABLE `group` DROP genre_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE group_genre');
        $this->addSql('ALTER TABLE `group` ADD genre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C54296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6DC044C54296D31F ON `group` (genre_id)');
    }
}
