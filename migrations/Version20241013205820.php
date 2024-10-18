<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241013205820 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE commande ADD etat_id INT NOT NULL, DROP etat');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_979CC42BD5E86FF FOREIGN KEY (etat_id) REFERENCES `Etat` (id)');
        $this->addSql('CREATE INDEX IDX_979CC42BD5E86FF ON commande (etat_id)');
        $this->addSql('ALTER TABLE day CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE day_marche ADD CONSTRAINT FK_1D7F61119C24126 FOREIGN KEY (day_id) REFERENCES `Day` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE day_marche ADD CONSTRAINT FK_1D7F61119E494911 FOREIGN KEY (marche_id) REFERENCES `Marche` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE historique RENAME INDEX idx_edbfd5ece32e4b46 TO IDX_A2E2D63CE32E4B46');
        $this->addSql('ALTER TABLE marche ADD hourly VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE produit CHANGE preoduct_name product_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE produit RENAME INDEX idx_29a5ec27e2e3a0b6 TO IDX_E618D5BBE2E3A0B6');
        $this->addSql('ALTER TABLE user ADD date_de_creation DATETIME NOT NULL, CHANGE place_marche num_siret VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user_categorie ADD CONSTRAINT FK_499D5BD0A76ED395 FOREIGN KEY (user_id) REFERENCES `User` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_categorie ADD CONSTRAINT FK_499D5BD0BCF5E72D FOREIGN KEY (categorie_id) REFERENCES `Categorie` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT NOT NULL, body LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, headers LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, queue_name VARCHAR(190) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E016BA31DB (delivered_at), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E0FB7336F0 (queue_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `Produit` CHANGE product_name preoduct_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `Produit` RENAME INDEX idx_e618d5bbe2e3a0b6 TO IDX_29A5EC27E2E3A0B6');
        $this->addSql('ALTER TABLE day_marche DROP FOREIGN KEY FK_1D7F61119C24126');
        $this->addSql('ALTER TABLE day_marche DROP FOREIGN KEY FK_1D7F61119E494911');
        $this->addSql('ALTER TABLE `Historique` RENAME INDEX idx_a2e2d63ce32e4b46 TO IDX_EDBFD5ECE32E4B46');
        $this->addSql('ALTER TABLE `Commande` DROP FOREIGN KEY FK_979CC42BD5E86FF');
        $this->addSql('DROP INDEX IDX_979CC42BD5E86FF ON `Commande`');
        $this->addSql('ALTER TABLE `Commande` ADD etat VARCHAR(255) NOT NULL, DROP etat_id');
        $this->addSql('ALTER TABLE user_categorie DROP FOREIGN KEY FK_499D5BD0A76ED395');
        $this->addSql('ALTER TABLE user_categorie DROP FOREIGN KEY FK_499D5BD0BCF5E72D');
        $this->addSql('ALTER TABLE `User` DROP date_de_creation, CHANGE num_siret place_marche VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `Marche` DROP hourly');
        $this->addSql('ALTER TABLE `Day` CHANGE id id INT NOT NULL');
    }
}
