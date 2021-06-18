<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210618140322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement_user (abonnement_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_F4A0F513F1D74413 (abonnement_id), INDEX IDX_F4A0F513A76ED395 (user_id), PRIMARY KEY(abonnement_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_post (user_id INT NOT NULL, post_id INT NOT NULL, INDEX IDX_200B2044A76ED395 (user_id), INDEX IDX_200B20444B89032C (post_id), PRIMARY KEY(user_id, post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement_user ADD CONSTRAINT FK_F4A0F513F1D74413 FOREIGN KEY (abonnement_id) REFERENCES abonnement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE abonnement_user ADD CONSTRAINT FK_F4A0F513A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_post ADD CONSTRAINT FK_200B2044A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_post ADD CONSTRAINT FK_200B20444B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BBAC24F853');
        $this->addSql('DROP INDEX UNIQ_351268BBAC24F853 ON abonnement');
        $this->addSql('ALTER TABLE abonnement CHANGE follower_id follower INT NOT NULL');
        $this->addSql('ALTER TABLE post DROP picts');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE abonnement_user');
        $this->addSql('DROP TABLE user_post');
        $this->addSql('ALTER TABLE abonnement CHANGE follower follower_id INT NOT NULL');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BBAC24F853 FOREIGN KEY (follower_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_351268BBAC24F853 ON abonnement (follower_id)');
        $this->addSql('ALTER TABLE post ADD picts VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
