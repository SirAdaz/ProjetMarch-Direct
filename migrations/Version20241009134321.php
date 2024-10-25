<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241009134321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_979CC42BD5E86FF FOREIGN KEY (etat_id) REFERENCES `Etat` (id)');
        $this->addSql('ALTER TABLE commande_historique ADD CONSTRAINT FK_757DF90A82EA2E54 FOREIGN KEY (commande_id) REFERENCES `Commande` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_historique ADD CONSTRAINT FK_757DF90A6128735E FOREIGN KEY (historique_id) REFERENCES `Historique` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_user ADD CONSTRAINT FK_E6FFD7AA82EA2E54 FOREIGN KEY (commande_id) REFERENCES `Commande` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_user ADD CONSTRAINT FK_E6FFD7AAA76ED395 FOREIGN KEY (user_id) REFERENCES `User` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_user ADD CONSTRAINT FK_ABA574A5F8697D13 FOREIGN KEY (comment_id) REFERENCES `Comment` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_user ADD CONSTRAINT FK_ABA574A5A76ED395 FOREIGN KEY (user_id) REFERENCES `User` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE day CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE day_marche ADD CONSTRAINT FK_1D7F61119C24126 FOREIGN KEY (day_id) REFERENCES `Day` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE day_marche ADD CONSTRAINT FK_1D7F61119E494911 FOREIGN KEY (marche_id) REFERENCES `Marche` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etat CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE historique CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_A2E2D63CE32E4B46 FOREIGN KEY (user_histo_id) REFERENCES `User` (id)');
        $this->addSql('ALTER TABLE marche CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE marche_user ADD CONSTRAINT FK_B82784B29E494911 FOREIGN KEY (marche_id) REFERENCES `Marche` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE marche_user ADD CONSTRAINT FK_B82784B2A76ED395 FOREIGN KEY (user_id) REFERENCES `User` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_E618D5BBE2E3A0B6 FOREIGN KEY (user_product_id) REFERENCES `User` (id)');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946EF347EFB FOREIGN KEY (produit_id) REFERENCES `Produit` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946E82EA2E54 FOREIGN KEY (commande_id) REFERENCES `Commande` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_categorie ADD CONSTRAINT FK_499D5BD0A76ED395 FOREIGN KEY (user_id) REFERENCES `User` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_categorie ADD CONSTRAINT FK_499D5BD0BCF5E72D FOREIGN KEY (categorie_id) REFERENCES `Categorie` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `Day` CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE day_marche DROP FOREIGN KEY FK_1D7F61119C24126');
        $this->addSql('ALTER TABLE day_marche DROP FOREIGN KEY FK_1D7F61119E494911');
        $this->addSql('ALTER TABLE user_categorie DROP FOREIGN KEY FK_499D5BD0A76ED395');
        $this->addSql('ALTER TABLE user_categorie DROP FOREIGN KEY FK_499D5BD0BCF5E72D');
        $this->addSql('ALTER TABLE `Commande` DROP FOREIGN KEY FK_979CC42BD5E86FF');
        $this->addSql('ALTER TABLE `Marche` CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE commande_historique DROP FOREIGN KEY FK_757DF90A82EA2E54');
        $this->addSql('ALTER TABLE commande_historique DROP FOREIGN KEY FK_757DF90A6128735E');
        $this->addSql('ALTER TABLE marche_user DROP FOREIGN KEY FK_B82784B29E494911');
        $this->addSql('ALTER TABLE marche_user DROP FOREIGN KEY FK_B82784B2A76ED395');
        $this->addSql('ALTER TABLE commande_user DROP FOREIGN KEY FK_E6FFD7AA82EA2E54');
        $this->addSql('ALTER TABLE commande_user DROP FOREIGN KEY FK_E6FFD7AAA76ED395');
        $this->addSql('ALTER TABLE `Etat` CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE `Produit` DROP FOREIGN KEY FK_E618D5BBE2E3A0B6');
        $this->addSql('ALTER TABLE `Produit` CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE produit_commande DROP FOREIGN KEY FK_47F5946EF347EFB');
        $this->addSql('ALTER TABLE produit_commande DROP FOREIGN KEY FK_47F5946E82EA2E54');
        $this->addSql('ALTER TABLE comment_user DROP FOREIGN KEY FK_ABA574A5F8697D13');
        $this->addSql('ALTER TABLE comment_user DROP FOREIGN KEY FK_ABA574A5A76ED395');
        $this->addSql('ALTER TABLE `Historique` DROP FOREIGN KEY FK_A2E2D63CE32E4B46');
        $this->addSql('ALTER TABLE `Historique` CHANGE id id INT NOT NULL');
    }
}
