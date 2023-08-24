<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230811131515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question_option DROP FOREIGN KEY FK_5DDB2FB81E27F6BF');
        $this->addSql('DROP TABLE question_option');
        $this->addSql('ALTER TABLE question ADD option1 VARCHAR(100) NOT NULL, ADD option2 VARCHAR(100) NOT NULL, ADD option3 VARCHAR(100) NOT NULL, ADD option4 VARCHAR(100) NOT NULL, ADD answer VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE question_option (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, `option` VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, answer TINYINT(1) NOT NULL, INDEX IDX_5DDB2FB81E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE question_option ADD CONSTRAINT FK_5DDB2FB81E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE question DROP option1, DROP option2, DROP option3, DROP option4, DROP answer');
    }
}
