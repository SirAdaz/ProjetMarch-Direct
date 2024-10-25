<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241011081614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `Categorie` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `Commande` (id INT AUTO_INCREMENT NOT NULL, etat_id INT NOT NULL, produits_commande JSON NOT NULL, date DATETIME NOT NULL, hour_recup VARCHAR(255) NOT NULL, INDEX IDX_979CC42BD5E86FF (etat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_historique (commande_id INT NOT NULL, historique_id INT NOT NULL, INDEX IDX_757DF90A82EA2E54 (commande_id), INDEX IDX_757DF90A6128735E (historique_id), PRIMARY KEY(commande_id, historique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_user (commande_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E6FFD7AA82EA2E54 (commande_id), INDEX IDX_E6FFD7AAA76ED395 (user_id), PRIMARY KEY(commande_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `Comment` (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, note INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment_user (comment_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_ABA574A5F8697D13 (comment_id), INDEX IDX_ABA574A5A76ED395 (user_id), PRIMARY KEY(comment_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `Day` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE day_marche (day_id INT NOT NULL, marche_id INT NOT NULL, INDEX IDX_1D7F61119C24126 (day_id), INDEX IDX_1D7F61119E494911 (marche_id), PRIMARY KEY(day_id, marche_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `Etat` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `Historique` (id INT AUTO_INCREMENT NOT NULL, user_histo_id INT DEFAULT NULL, date DATETIME NOT NULL, INDEX IDX_A2E2D63CE32E4B46 (user_histo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `Marche` (id INT AUTO_INCREMENT NOT NULL, marche_name VARCHAR(255) NOT NULL, place VARCHAR(255) NOT NULL, hourly VARCHAR(255) NOT NULL, image_file_name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marche_user (marche_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B82784B29E494911 (marche_id), INDEX IDX_B82784B2A76ED395 (user_id), PRIMARY KEY(marche_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `Produit` (id INT AUTO_INCREMENT NOT NULL, user_product_id INT DEFAULT NULL, product_name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, stock INT NOT NULL, disponibility TINYINT(1) NOT NULL, image_file_name VARCHAR(255) NOT NULL, INDEX IDX_E618D5BBE2E3A0B6 (user_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_commande (produit_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_47F5946EF347EFB (produit_id), INDEX IDX_47F5946E82EA2E54 (commande_id), PRIMARY KEY(produit_id, commande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `User` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, user_name VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, name_business VARCHAR(255) DEFAULT NULL, stats JSON DEFAULT NULL, image_file_name VARCHAR(255) NOT NULL, description_commerce LONGTEXT DEFAULT NULL, date_de_creation DATETIME NOT NULL, num_siret VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_categorie (user_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_499D5BD0A76ED395 (user_id), INDEX IDX_499D5BD0BCF5E72D (categorie_id), PRIMARY KEY(user_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `Commande` ADD CONSTRAINT FK_979CC42BD5E86FF FOREIGN KEY (etat_id) REFERENCES `Etat` (id)');
        $this->addSql('ALTER TABLE commande_historique ADD CONSTRAINT FK_757DF90A82EA2E54 FOREIGN KEY (commande_id) REFERENCES `Commande` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_historique ADD CONSTRAINT FK_757DF90A6128735E FOREIGN KEY (historique_id) REFERENCES `Historique` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_user ADD CONSTRAINT FK_E6FFD7AA82EA2E54 FOREIGN KEY (commande_id) REFERENCES `Commande` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_user ADD CONSTRAINT FK_E6FFD7AAA76ED395 FOREIGN KEY (user_id) REFERENCES `User` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_user ADD CONSTRAINT FK_ABA574A5F8697D13 FOREIGN KEY (comment_id) REFERENCES `Comment` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_user ADD CONSTRAINT FK_ABA574A5A76ED395 FOREIGN KEY (user_id) REFERENCES `User` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE day_marche ADD CONSTRAINT FK_1D7F61119C24126 FOREIGN KEY (day_id) REFERENCES `Day` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE day_marche ADD CONSTRAINT FK_1D7F61119E494911 FOREIGN KEY (marche_id) REFERENCES `Marche` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `Historique` ADD CONSTRAINT FK_A2E2D63CE32E4B46 FOREIGN KEY (user_histo_id) REFERENCES `User` (id)');
        $this->addSql('ALTER TABLE marche_user ADD CONSTRAINT FK_B82784B29E494911 FOREIGN KEY (marche_id) REFERENCES `Marche` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE marche_user ADD CONSTRAINT FK_B82784B2A76ED395 FOREIGN KEY (user_id) REFERENCES `User` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `Produit` ADD CONSTRAINT FK_E618D5BBE2E3A0B6 FOREIGN KEY (user_product_id) REFERENCES `User` (id)');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946EF347EFB FOREIGN KEY (produit_id) REFERENCES `Produit` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946E82EA2E54 FOREIGN KEY (commande_id) REFERENCES `Commande` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_categorie ADD CONSTRAINT FK_499D5BD0A76ED395 FOREIGN KEY (user_id) REFERENCES `User` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_categorie ADD CONSTRAINT FK_499D5BD0BCF5E72D FOREIGN KEY (categorie_id) REFERENCES `Categorie` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `Commande` DROP FOREIGN KEY FK_979CC42BD5E86FF');
        $this->addSql('ALTER TABLE commande_historique DROP FOREIGN KEY FK_757DF90A82EA2E54');
        $this->addSql('ALTER TABLE commande_historique DROP FOREIGN KEY FK_757DF90A6128735E');
        $this->addSql('ALTER TABLE commande_user DROP FOREIGN KEY FK_E6FFD7AA82EA2E54');
        $this->addSql('ALTER TABLE commande_user DROP FOREIGN KEY FK_E6FFD7AAA76ED395');
        $this->addSql('ALTER TABLE comment_user DROP FOREIGN KEY FK_ABA574A5F8697D13');
        $this->addSql('ALTER TABLE comment_user DROP FOREIGN KEY FK_ABA574A5A76ED395');
        $this->addSql('ALTER TABLE day_marche DROP FOREIGN KEY FK_1D7F61119C24126');
        $this->addSql('ALTER TABLE day_marche DROP FOREIGN KEY FK_1D7F61119E494911');
        $this->addSql('ALTER TABLE `Historique` DROP FOREIGN KEY FK_A2E2D63CE32E4B46');
        $this->addSql('ALTER TABLE marche_user DROP FOREIGN KEY FK_B82784B29E494911');
        $this->addSql('ALTER TABLE marche_user DROP FOREIGN KEY FK_B82784B2A76ED395');
        $this->addSql('ALTER TABLE `Produit` DROP FOREIGN KEY FK_E618D5BBE2E3A0B6');
        $this->addSql('ALTER TABLE produit_commande DROP FOREIGN KEY FK_47F5946EF347EFB');
        $this->addSql('ALTER TABLE produit_commande DROP FOREIGN KEY FK_47F5946E82EA2E54');
        $this->addSql('ALTER TABLE user_categorie DROP FOREIGN KEY FK_499D5BD0A76ED395');
        $this->addSql('ALTER TABLE user_categorie DROP FOREIGN KEY FK_499D5BD0BCF5E72D');
        $this->addSql('DROP TABLE `Categorie`');
        $this->addSql('DROP TABLE `Commande`');
        $this->addSql('DROP TABLE commande_historique');
        $this->addSql('DROP TABLE commande_user');
        $this->addSql('DROP TABLE `Comment`');
        $this->addSql('DROP TABLE comment_user');
        $this->addSql('DROP TABLE `Day`');
        $this->addSql('DROP TABLE day_marche');
        $this->addSql('DROP TABLE `Etat`');
        $this->addSql('DROP TABLE `Historique`');
        $this->addSql('DROP TABLE `Marche`');
        $this->addSql('DROP TABLE marche_user');
        $this->addSql('DROP TABLE `Produit`');
        $this->addSql('DROP TABLE produit_commande');
        $this->addSql('DROP TABLE `User`');
        $this->addSql('DROP TABLE user_categorie');
    }
}
