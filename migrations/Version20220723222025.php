<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220723222025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Created Favorites table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favorites (id INT AUTO_INCREMENT NOT NULL, price_id INT NOT NULL, category_id INT NOT NULL, favorite_image_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, INDEX IDX_E46960F5D614C7E7 (price_id), INDEX IDX_E46960F512469DE2 (category_id), INDEX IDX_E46960F597F23D9C (favorite_image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F5D614C7E7 FOREIGN KEY (price_id) REFERENCES price (id)');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F597F23D9C FOREIGN KEY (favorite_image_id) REFERENCES media_object (id)');
        $this->addSql('ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4C9411483B FOREIGN KEY (course_image_id) REFERENCES media_object (id)');
        $this->addSql('CREATE INDEX IDX_A9A55A4C9411483B ON courses (course_image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE favorites');
        $this->addSql('ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4C9411483B');
        $this->addSql('DROP INDEX IDX_A9A55A4C9411483B ON courses');
    }
}
