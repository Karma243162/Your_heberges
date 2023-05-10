<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230508083539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ajouts (id INT AUTO_INCREMENT NOT NULL, panier_id INT DEFAULT NULL, webheberge_id INT DEFAULT NULL, qte INT NOT NULL, INDEX IDX_12C8C32AF77D927C (panier_id), INDEX IDX_12C8C32A173E50D0 (webheberge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ajouts ADD CONSTRAINT FK_12C8C32AF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE ajouts ADD CONSTRAINT FK_12C8C32A173E50D0 FOREIGN KEY (webheberge_id) REFERENCES webheberge (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ajouts DROP FOREIGN KEY FK_12C8C32AF77D927C');
        $this->addSql('ALTER TABLE ajouts DROP FOREIGN KEY FK_12C8C32A173E50D0');
        $this->addSql('DROP TABLE ajouts');
    }
}
