<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241004130609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_user DROP FOREIGN KEY FK_FABA511EBCF5E72D');
        $this->addSql('ALTER TABLE categorie_user DROP FOREIGN KEY FK_FABA511EA76ED395');
        $this->addSql('DROP TABLE categorie_user');
        $this->addSql('ALTER TABLE categorie ADD name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_user (categorie_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FABA511EBCF5E72D (categorie_id), INDEX IDX_FABA511EA76ED395 (user_id), PRIMARY KEY(categorie_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE categorie_user ADD CONSTRAINT FK_FABA511EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_user ADD CONSTRAINT FK_FABA511EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie DROP name');
    }
}
