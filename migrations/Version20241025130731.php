<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241025130731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_5BC96BF0A76ED395 FOREIGN KEY (user_id) REFERENCES `User` (id)');
        $this->addSql('CREATE INDEX IDX_5BC96BF0A76ED395 ON comment (user_id)');
        $this->addSql('ALTER TABLE produit ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_E618D5BBBCF5E72D FOREIGN KEY (categorie_id) REFERENCES `Categorie` (id)');
        $this->addSql('CREATE INDEX IDX_E618D5BBBCF5E72D ON produit (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `Produit` DROP FOREIGN KEY FK_E618D5BBBCF5E72D');
        $this->addSql('DROP INDEX IDX_E618D5BBBCF5E72D ON `Produit`');
        $this->addSql('ALTER TABLE `Produit` DROP categorie_id');
        $this->addSql('ALTER TABLE `Comment` DROP FOREIGN KEY FK_5BC96BF0A76ED395');
        $this->addSql('DROP INDEX IDX_5BC96BF0A76ED395 ON `Comment`');
    }
}
