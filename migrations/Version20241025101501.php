<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241025101501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `Categorie` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_categorie (user_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_499D5BD0A76ED395 (user_id), INDEX IDX_499D5BD0BCF5E72D (categorie_id), PRIMARY KEY(user_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_categorie ADD CONSTRAINT FK_499D5BD0A76ED395 FOREIGN KEY (user_id) REFERENCES `User` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_categorie ADD CONSTRAINT FK_499D5BD0BCF5E72D FOREIGN KEY (categorie_id) REFERENCES `Categorie` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_E618D5BBBCF5E72D FOREIGN KEY (categorie_id) REFERENCES `Categorie` (id)');
        $this->addSql('CREATE INDEX IDX_E618D5BBBCF5E72D ON produit (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `Produit` DROP FOREIGN KEY FK_E618D5BBBCF5E72D');
        $this->addSql('ALTER TABLE user_categorie DROP FOREIGN KEY FK_499D5BD0A76ED395');
        $this->addSql('ALTER TABLE user_categorie DROP FOREIGN KEY FK_499D5BD0BCF5E72D');
        $this->addSql('DROP TABLE `Categorie`');
        $this->addSql('DROP TABLE user_categorie');
        $this->addSql('DROP INDEX IDX_E618D5BBBCF5E72D ON `Produit`');
        $this->addSql('ALTER TABLE `Produit` DROP categorie_id');
    }
}
