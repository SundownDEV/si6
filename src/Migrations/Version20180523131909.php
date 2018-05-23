<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180523131909 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, image VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, twitter VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE kf7bnJ_comment');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE kf7bnJ_comment (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, author_id INT NOT NULL, content LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, published_at DATETIME NOT NULL, INDEX IDX_D5CDE9D04B89032C (post_id), INDEX IDX_D5CDE9D0F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kf7bnJ_comment ADD CONSTRAINT FK_D5CDE9D04B89032C FOREIGN KEY (post_id) REFERENCES fk1TmS_post (id)');
        $this->addSql('ALTER TABLE kf7bnJ_comment ADD CONSTRAINT FK_D5CDE9D0F675F31B FOREIGN KEY (author_id) REFERENCES s2FpUk_user (id)');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE company');
    }
}
