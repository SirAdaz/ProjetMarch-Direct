<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241004130203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_user (categorie_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FABA511EBCF5E72D (categorie_id), INDEX IDX_FABA511EA76ED395 (user_id), PRIMARY KEY(categorie_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_categorie (user_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_499D5BD0A76ED395 (user_id), INDEX IDX_499D5BD0BCF5E72D (categorie_id), PRIMARY KEY(user_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_user ADD CONSTRAINT FK_FABA511EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_user ADD CONSTRAINT FK_FABA511EA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_categorie ADD CONSTRAINT FK_499D5BD0A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_categorie ADD CONSTRAINT FK_499D5BD0BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD etat_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DD5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DD5E86FF ON commande (etat_id)');
        $this->addSql('ALTER TABLE produit CHANGE preoduct_name product_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_user DROP FOREIGN KEY FK_FABA511EBCF5E72D');
        $this->addSql('ALTER TABLE categorie_user DROP FOREIGN KEY FK_FABA511EA76ED395');
        $this->addSql('ALTER TABLE user_categorie DROP FOREIGN KEY FK_499D5BD0A76ED395');
        $this->addSql('ALTER TABLE user_categorie DROP FOREIGN KEY FK_499D5BD0BCF5E72D');
        $this->addSql('DROP TABLE categorie_user');
        $this->addSql('DROP TABLE user_categorie');
        $this->addSql('ALTER TABLE produit CHANGE product_name preoduct_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DD5E86FF');
        $this->addSql('DROP INDEX IDX_6EEAA67DD5E86FF ON commande');
        $this->addSql('ALTER TABLE commande DROP etat_id');
    }
}
