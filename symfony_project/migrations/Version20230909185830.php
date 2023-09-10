<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230909185830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contest (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, country VARCHAR(25) NOT NULL, city VARCHAR(25) NOT NULL, instrument VARCHAR(25) NOT NULL, prize VARCHAR(10) DEFAULT NULL, date DATE NOT NULL, seasonality VARCHAR(50) DEFAULT NULL, phone VARCHAR(100) DEFAULT NULL, address VARCHAR(200) NOT NULL, winners LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', juries LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contest');
    }
}
