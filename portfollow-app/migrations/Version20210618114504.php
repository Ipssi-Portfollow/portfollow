<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210618114504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BBAC24F853');
        $this->addSql('DROP INDEX UNIQ_351268BBAC24F853 ON abonnement');
        $this->addSql('ALTER TABLE abonnement CHANGE follower_id follower INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonnement CHANGE follower follower_id INT NOT NULL');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BBAC24F853 FOREIGN KEY (follower_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_351268BBAC24F853 ON abonnement (follower_id)');
    }
}
