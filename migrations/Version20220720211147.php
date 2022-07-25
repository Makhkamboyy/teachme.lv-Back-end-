<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220720211147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Added image to Trainer table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trainer ADD image_id INT NOT NULL');
        $this->addSql('ALTER TABLE trainer ADD CONSTRAINT FK_C51508203DA5256D FOREIGN KEY (image_id) REFERENCES media_object (id)');
        $this->addSql('CREATE INDEX IDX_C51508203DA5256D ON trainer (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trainer DROP FOREIGN KEY FK_C51508203DA5256D');
        $this->addSql('DROP INDEX IDX_C51508203DA5256D ON trainer');
        $this->addSql('ALTER TABLE trainer DROP image_id');
    }
}
