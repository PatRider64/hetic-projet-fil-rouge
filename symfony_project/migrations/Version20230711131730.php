<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230711131730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE challenge (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE challenge_user_site (challenge_id INT NOT NULL, user_site_id INT NOT NULL, INDEX IDX_B35599B298A21AC6 (challenge_id), INDEX IDX_B35599B2AEB0084C (user_site_id), PRIMARY KEY(challenge_id, user_site_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chat (id INT AUTO_INCREMENT NOT NULL, topic VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compositor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, first_name VARCHAR(32) NOT NULL, birth_date DATE NOT NULL, death_date DATE NOT NULL, biography LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, teacher_id INT DEFAULT NULL, title VARCHAR(50) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX IDX_169E6FB941807E1D (teacher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE masterclass (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, music_sheet_id INT DEFAULT NULL, analysis LONGTEXT DEFAULT NULL, instruments LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_9BDB44EDCB944F1A (student_id), INDEX IDX_9BDB44ED4C015A83 (music_sheet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_site_id INT DEFAULT NULL, chat_id INT DEFAULT NULL, date DATETIME DEFAULT NULL, content LONGTEXT NOT NULL, INDEX IDX_B6BD307FAEB0084C (user_site_id), INDEX IDX_B6BD307F1A9A7125 (chat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music_sheet (id INT AUTO_INCREMENT NOT NULL, compositor_id INT DEFAULT NULL, file_name VARCHAR(100) DEFAULT NULL, original_file_name VARCHAR(255) DEFAULT NULL, mime_type VARCHAR(50) DEFAULT NULL, INDEX IDX_E0B5EA2AE74E5782 (compositor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, quiz_id INT DEFAULT NULL, question VARCHAR(150) NOT NULL, INDEX IDX_B6F7494E853CD175 (quiz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_answer (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, answer VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_DD80652D1E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_option (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, `option` VARCHAR(150) NOT NULL, INDEX IDX_5DDB2FB81E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_site (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, first_name VARCHAR(32) NOT NULL, email VARCHAR(60) NOT NULL, type LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', video_count INT DEFAULT NULL, courses_taken INT DEFAULT NULL, quizzes_completed LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', expiration_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE challenge_user_site ADD CONSTRAINT FK_B35599B298A21AC6 FOREIGN KEY (challenge_id) REFERENCES challenge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE challenge_user_site ADD CONSTRAINT FK_B35599B2AEB0084C FOREIGN KEY (user_site_id) REFERENCES user_site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB941807E1D FOREIGN KEY (teacher_id) REFERENCES user_site (id)');
        $this->addSql('ALTER TABLE masterclass ADD CONSTRAINT FK_9BDB44EDCB944F1A FOREIGN KEY (student_id) REFERENCES user_site (id)');
        $this->addSql('ALTER TABLE masterclass ADD CONSTRAINT FK_9BDB44ED4C015A83 FOREIGN KEY (music_sheet_id) REFERENCES music_sheet (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FAEB0084C FOREIGN KEY (user_site_id) REFERENCES user_site (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F1A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id)');
        $this->addSql('ALTER TABLE music_sheet ADD CONSTRAINT FK_E0B5EA2AE74E5782 FOREIGN KEY (compositor_id) REFERENCES compositor (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('ALTER TABLE question_answer ADD CONSTRAINT FK_DD80652D1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE question_option ADD CONSTRAINT FK_5DDB2FB81E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE challenge_user_site DROP FOREIGN KEY FK_B35599B298A21AC6');
        $this->addSql('ALTER TABLE challenge_user_site DROP FOREIGN KEY FK_B35599B2AEB0084C');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB941807E1D');
        $this->addSql('ALTER TABLE masterclass DROP FOREIGN KEY FK_9BDB44EDCB944F1A');
        $this->addSql('ALTER TABLE masterclass DROP FOREIGN KEY FK_9BDB44ED4C015A83');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FAEB0084C');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F1A9A7125');
        $this->addSql('ALTER TABLE music_sheet DROP FOREIGN KEY FK_E0B5EA2AE74E5782');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E853CD175');
        $this->addSql('ALTER TABLE question_answer DROP FOREIGN KEY FK_DD80652D1E27F6BF');
        $this->addSql('ALTER TABLE question_option DROP FOREIGN KEY FK_5DDB2FB81E27F6BF');
        $this->addSql('DROP TABLE challenge');
        $this->addSql('DROP TABLE challenge_user_site');
        $this->addSql('DROP TABLE chat');
        $this->addSql('DROP TABLE compositor');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE masterclass');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE music_sheet');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_answer');
        $this->addSql('DROP TABLE question_option');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE user_site');
    }
}
