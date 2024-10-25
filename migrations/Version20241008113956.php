<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241008113956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE day_marche (day_id INT NOT NULL, marche_id INT NOT NULL, INDEX IDX_1D7F61119C24126 (day_id), INDEX IDX_1D7F61119E494911 (marche_id), PRIMARY KEY(day_id, marche_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE day_marche ADD CONSTRAINT FK_1D7F61119C24126 FOREIGN KEY (day_id) REFERENCES `Day` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE day_marche ADD CONSTRAINT FK_1D7F61119E494911 FOREIGN KEY (marche_id) REFERENCES `Marche` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE day_marche DROP FOREIGN KEY FK_1D7F61119C24126');
        $this->addSql('ALTER TABLE day_marche DROP FOREIGN KEY FK_1D7F61119E494911');
        $this->addSql('DROP TABLE day_marche');
    }
}
