<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221231173825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formule (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(60) NOT NULL, description VARCHAR(255) NOT NULL, prix NUMERIC(6, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formule_plat (formule_id INT NOT NULL, plat_id INT NOT NULL, INDEX IDX_6BA65CA22A68F4D1 (formule_id), INDEX IDX_6BA65CA2D73DB560 (plat_id), PRIMARY KEY(formule_id, plat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_formule (menu_id INT NOT NULL, formule_id INT NOT NULL, INDEX IDX_E8878126CCD7E912 (menu_id), INDEX IDX_E88781262A68F4D1 (formule_id), PRIMARY KEY(menu_id, formule_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formule_plat ADD CONSTRAINT FK_6BA65CA22A68F4D1 FOREIGN KEY (formule_id) REFERENCES formule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formule_plat ADD CONSTRAINT FK_6BA65CA2D73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_formule ADD CONSTRAINT FK_E8878126CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_formule ADD CONSTRAINT FK_E88781262A68F4D1 FOREIGN KEY (formule_id) REFERENCES formule (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formule_plat DROP FOREIGN KEY FK_6BA65CA22A68F4D1');
        $this->addSql('ALTER TABLE formule_plat DROP FOREIGN KEY FK_6BA65CA2D73DB560');
        $this->addSql('ALTER TABLE menu_formule DROP FOREIGN KEY FK_E8878126CCD7E912');
        $this->addSql('ALTER TABLE menu_formule DROP FOREIGN KEY FK_E88781262A68F4D1');
        $this->addSql('DROP TABLE formule');
        $this->addSql('DROP TABLE formule_plat');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_formule');
    }
}
