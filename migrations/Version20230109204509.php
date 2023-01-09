<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109204509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horaire ADD jour VARCHAR(60) NOT NULL, ADD ouverture_midi TIME DEFAULT NULL, ADD fermeture_midi TIME DEFAULT NULL, ADD ouverture_soir TIME DEFAULT NULL, ADD fermeture_soir TIME DEFAULT NULL, DROP heure_ouverture_matin, DROP horaire_fermeture_matin, DROP horaire_ouverture_soir, DROP horaire_fermeture_soir, CHANGE capacite_matin capacite_midi INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horaire ADD heure_ouverture_matin DATE DEFAULT NULL, ADD horaire_fermeture_matin DATE DEFAULT NULL, ADD horaire_ouverture_soir DATE DEFAULT NULL, ADD horaire_fermeture_soir DATE DEFAULT NULL, DROP jour, DROP ouverture_midi, DROP fermeture_midi, DROP ouverture_soir, DROP fermeture_soir, CHANGE capacite_midi capacite_matin INT DEFAULT NULL');
    }
}
