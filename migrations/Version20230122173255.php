<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230122173255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_formule DROP FOREIGN KEY FK_E88781262A68F4D1');
        $this->addSql('ALTER TABLE menu_formule DROP FOREIGN KEY FK_E8878126CCD7E912');
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A2078A3C7387');
        $this->addSql('ALTER TABLE formule_plat DROP FOREIGN KEY FK_6BA65CA22A68F4D1');
        $this->addSql('ALTER TABLE formule_plat DROP FOREIGN KEY FK_6BA65CA2D73DB560');
        $this->addSql('DROP TABLE rush_hour');
        $this->addSql('DROP TABLE menu_formule');
        $this->addSql('DROP TABLE plat');
        $this->addSql('DROP TABLE formule_plat');
        $this->addSql('DROP TABLE formule');
        $this->addSql('DROP TABLE categorie_du_plat');
        $this->addSql('ALTER TABLE menu ADD formule VARCHAR(100) NOT NULL, CHANGE nom nom VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rush_hour (id INT AUTO_INCREMENT NOT NULL, day VARCHAR(60) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, morning_opening_hour TIME DEFAULT NULL, morning_closing_hour TIME DEFAULT NULL, evening_opening_hour TIME DEFAULT NULL, evening_closing_hour TIME DEFAULT NULL, capacite INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE menu_formule (menu_id INT NOT NULL, formule_id INT NOT NULL, INDEX IDX_E8878126CCD7E912 (menu_id), INDEX IDX_E88781262A68F4D1 (formule_id), PRIMARY KEY(menu_id, formule_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE plat (id INT AUTO_INCREMENT NOT NULL, categorie_id_id INT DEFAULT NULL, nom VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prix INT NOT NULL, display_in_gallery TINYINT(1) NOT NULL, image_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_2038A2078A3C7387 (categorie_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE formule_plat (formule_id INT NOT NULL, plat_id INT NOT NULL, INDEX IDX_6BA65CA2D73DB560 (plat_id), INDEX IDX_6BA65CA22A68F4D1 (formule_id), PRIMARY KEY(formule_id, plat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE formule (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prix NUMERIC(6, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie_du_plat (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE menu_formule ADD CONSTRAINT FK_E88781262A68F4D1 FOREIGN KEY (formule_id) REFERENCES formule (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_formule ADD CONSTRAINT FK_E8878126CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A2078A3C7387 FOREIGN KEY (categorie_id_id) REFERENCES categorie_du_plat (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE formule_plat ADD CONSTRAINT FK_6BA65CA22A68F4D1 FOREIGN KEY (formule_id) REFERENCES formule (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formule_plat ADD CONSTRAINT FK_6BA65CA2D73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu DROP formule, CHANGE nom nom VARCHAR(60) NOT NULL');
    }
}
