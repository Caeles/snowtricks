<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250623193233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE reset_password (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, expired_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', UNIQUE INDEX UNIQ_B9983CE5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reset_password ADD CONSTRAINT FK_B9983CE5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX name ON category
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX slug ON category
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE category CHANGE createdAt createdAt DATETIME NOT NULL, CHANGE updatedAt updatedAt DATETIME NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY fk_comment_author
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY fk_comment_trick
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY fk_comment_author
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY fk_comment_trick
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment CHANGE content content LONGTEXT NOT NULL, CHANGE createdAt createdAt DATETIME NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT FK_9474526CB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_comment_trick ON comment
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_9474526CB281BE2E ON comment (trick_id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_comment_author ON comment
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT fk_comment_author FOREIGN KEY (author_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT fk_comment_trick FOREIGN KEY (trick_id) REFERENCES trick (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE image DROP FOREIGN KEY fk_image_trick
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE image DROP FOREIGN KEY fk_image_trick
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE image CHANGE filename filename VARCHAR(255) NOT NULL, CHANGE createdAt createdAt DATETIME NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE image ADD CONSTRAINT FK_C53D045FB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_image_trick ON image
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C53D045FB281BE2E ON image (trick_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE image ADD CONSTRAINT fk_image_trick FOREIGN KEY (trick_id) REFERENCES trick (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE trick DROP FOREIGN KEY fk_trick_author
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX slug ON trick
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE trick DROP FOREIGN KEY fk_trick_author
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE trick DROP FOREIGN KEY fk_trick_category
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE trick CHANGE author_id author_id INT DEFAULT NULL, CHANGE category_id category_id INT DEFAULT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE createdAt createdAt DATETIME NOT NULL, CHANGE updatedAt updatedAt DATETIME NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EF675F31B FOREIGN KEY (author_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_trick_author ON trick
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D8F0A91EF675F31B ON trick (author_id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_trick_category ON trick
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D8F0A91E12469DE2 ON trick (category_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE trick ADD CONSTRAINT fk_trick_author FOREIGN KEY (author_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE trick ADD CONSTRAINT fk_trick_category FOREIGN KEY (category_id) REFERENCES category (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user CHANGE createdAt createdAt DATETIME NOT NULL, CHANGE updatedAt updatedAt DATETIME NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX username ON user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX email ON user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE video DROP FOREIGN KEY fk_video_trick
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE video DROP FOREIGN KEY fk_video_trick
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE video CHANGE url url VARCHAR(500) NOT NULL, CHANGE platform platform VARCHAR(50) DEFAULT NULL, CHANGE createdAt createdAt DATETIME NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_video_trick ON video
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7CC7DA2CB281BE2E ON video (trick_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE video ADD CONSTRAINT fk_video_trick FOREIGN KEY (trick_id) REFERENCES trick (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE reset_password DROP FOREIGN KEY FK_B9983CE5A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reset_password
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE category CHANGE createdAt createdAt DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updatedAt updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX name ON category (name)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX slug ON category (slug)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB281BE2E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB281BE2E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment CHANGE content content TEXT NOT NULL, CHANGE createdAt createdAt DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT fk_comment_author FOREIGN KEY (author_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT fk_comment_trick FOREIGN KEY (trick_id) REFERENCES trick (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_9474526cb281be2e ON comment
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_comment_trick ON comment (trick_id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_9474526cf675f31b ON comment
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_comment_author ON comment (author_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT FK_9474526CB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE image DROP FOREIGN KEY FK_C53D045FB281BE2E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE image DROP FOREIGN KEY FK_C53D045FB281BE2E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE image CHANGE filename filename VARCHAR(255) NOT NULL COMMENT 'Name of the image file', CHANGE createdAt createdAt DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE image ADD CONSTRAINT fk_image_trick FOREIGN KEY (trick_id) REFERENCES trick (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_c53d045fb281be2e ON image
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_image_trick ON image (trick_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE image ADD CONSTRAINT FK_C53D045FB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91EF675F31B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91EF675F31B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91E12469DE2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE trick CHANGE author_id author_id INT NOT NULL, CHANGE category_id category_id INT NOT NULL, CHANGE description description TEXT NOT NULL, CHANGE createdAt createdAt DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updatedAt updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE trick ADD CONSTRAINT fk_trick_author FOREIGN KEY (author_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX slug ON trick (slug)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_d8f0a91ef675f31b ON trick
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_trick_author ON trick (author_id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_d8f0a91e12469de2 ON trick
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_trick_category ON trick (category_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EF675F31B FOREIGN KEY (author_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user CHANGE createdAt createdAt DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updatedAt updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX uniq_8d93d649f85e0677 ON user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX username ON user (username)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX uniq_8d93d649e7927c74 ON user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX email ON user (email)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CB281BE2E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CB281BE2E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE video CHANGE url url VARCHAR(500) NOT NULL COMMENT 'URL to the video (e.g., YouTube, Vimeo)', CHANGE platform platform VARCHAR(50) DEFAULT NULL COMMENT 'e.g., youtube, vimeo', CHANGE createdAt createdAt DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE video ADD CONSTRAINT fk_video_trick FOREIGN KEY (trick_id) REFERENCES trick (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_7cc7da2cb281be2e ON video
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_video_trick ON video (trick_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)
        SQL);
    }
}
