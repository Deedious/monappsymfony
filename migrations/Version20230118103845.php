<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230118103845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE barticles (id INT AUTO_INCREMENT NOT NULL, bcategory_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, author VARCHAR(255) NOT NULL, INDEX IDX_4E63538DC67D18F6 (bcategory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bcategories (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bcomments (id INT AUTO_INCREMENT NOT NULL, barticle_id INT DEFAULT NULL, INDEX IDX_AE20F4CFF22170FF (barticle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE barticles ADD CONSTRAINT FK_4E63538DC67D18F6 FOREIGN KEY (bcategory_id) REFERENCES bcategories (id)');
        $this->addSql('ALTER TABLE bcomments ADD CONSTRAINT FK_AE20F4CFF22170FF FOREIGN KEY (barticle_id) REFERENCES barticles (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE barticles DROP FOREIGN KEY FK_4E63538DC67D18F6');
        $this->addSql('ALTER TABLE bcomments DROP FOREIGN KEY FK_AE20F4CFF22170FF');
        $this->addSql('DROP TABLE barticles');
        $this->addSql('DROP TABLE bcategories');
        $this->addSql('DROP TABLE bcomments');
        $this->addSql('DROP TABLE items');
        $this->addSql('DROP TABLE user');
    }
}
