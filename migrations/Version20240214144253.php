<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214144253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE equipiers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE etablissement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE prestataire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE services_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE equipiers (id INT NOT NULL, reservation_id INT DEFAULT NULL, etablissement_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, jours_travail TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_24498A2AB83297E7 ON equipiers (reservation_id)');
        $this->addSql('CREATE INDEX IDX_24498A2AFF631228 ON equipiers (etablissement_id)');
        $this->addSql('COMMENT ON COLUMN equipiers.jours_travail IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE etablissement (id INT NOT NULL, prestataire_id INT NOT NULL, nom_etablissement VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, heure_open TIME(0) WITHOUT TIME ZONE NOT NULL, heure_close TIME(0) WITHOUT TIME ZONE NOT NULL, prix_h VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_20FD592CBE3DB2B7 ON etablissement (prestataire_id)');
        $this->addSql('CREATE TABLE etablissement_services (etablissement_id INT NOT NULL, services_id INT NOT NULL, PRIMARY KEY(etablissement_id, services_id))');
        $this->addSql('CREATE INDEX IDX_715B637CFF631228 ON etablissement_services (etablissement_id)');
        $this->addSql('CREATE INDEX IDX_715B637CAEF5A6C1 ON etablissement_services (services_id)');
        $this->addSql('CREATE TABLE prestataire (id INT NOT NULL, kbis VARCHAR(255) NOT NULL, nom_entreprise VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal INT NOT NULL, telephone INT NOT NULL, mail VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, equipiers_id INT DEFAULT NULL, users_id INT DEFAULT NULL, date_reservation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, note DOUBLE PRECISION NOT NULL, commentaire TEXT NOT NULL, heure_reservation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_42C849559DF78FD7 ON reservation (equipiers_id)');
        $this->addSql('CREATE INDEX IDX_42C8495567B3B43D ON reservation (users_id)');
        $this->addSql('COMMENT ON COLUMN reservation.date_reservation IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reservation.heure_reservation IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE reservation_services (reservation_id INT NOT NULL, services_id INT NOT NULL, PRIMARY KEY(reservation_id, services_id))');
        $this->addSql('CREATE INDEX IDX_EE87037DB83297E7 ON reservation_services (reservation_id)');
        $this->addSql('CREATE INDEX IDX_EE87037DAEF5A6C1 ON reservation_services (services_id)');
        $this->addSql('CREATE TABLE services (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_prestataire (user_id INT NOT NULL, prestataire_id INT NOT NULL, PRIMARY KEY(user_id, prestataire_id))');
        $this->addSql('CREATE INDEX IDX_C9B9AD15A76ED395 ON user_prestataire (user_id)');
        $this->addSql('CREATE INDEX IDX_C9B9AD15BE3DB2B7 ON user_prestataire (prestataire_id)');
        $this->addSql('ALTER TABLE equipiers ADD CONSTRAINT FK_24498A2AB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipiers ADD CONSTRAINT FK_24498A2AFF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CBE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etablissement_services ADD CONSTRAINT FK_715B637CFF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etablissement_services ADD CONSTRAINT FK_715B637CAEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559DF78FD7 FOREIGN KEY (equipiers_id) REFERENCES equipiers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495567B3B43D FOREIGN KEY (users_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation_services ADD CONSTRAINT FK_EE87037DB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation_services ADD CONSTRAINT FK_EE87037DAEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_prestataire ADD CONSTRAINT FK_C9B9AD15A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_prestataire ADD CONSTRAINT FK_C9B9AD15BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD roles JSON NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" DROP mdp');
        $this->addSql('ALTER TABLE "user" DROP role');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE equipiers_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE etablissement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE prestataire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE services_id_seq CASCADE');
        $this->addSql('ALTER TABLE equipiers DROP CONSTRAINT FK_24498A2AB83297E7');
        $this->addSql('ALTER TABLE equipiers DROP CONSTRAINT FK_24498A2AFF631228');
        $this->addSql('ALTER TABLE etablissement DROP CONSTRAINT FK_20FD592CBE3DB2B7');
        $this->addSql('ALTER TABLE etablissement_services DROP CONSTRAINT FK_715B637CFF631228');
        $this->addSql('ALTER TABLE etablissement_services DROP CONSTRAINT FK_715B637CAEF5A6C1');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C849559DF78FD7');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C8495567B3B43D');
        $this->addSql('ALTER TABLE reservation_services DROP CONSTRAINT FK_EE87037DB83297E7');
        $this->addSql('ALTER TABLE reservation_services DROP CONSTRAINT FK_EE87037DAEF5A6C1');
        $this->addSql('ALTER TABLE user_prestataire DROP CONSTRAINT FK_C9B9AD15A76ED395');
        $this->addSql('ALTER TABLE user_prestataire DROP CONSTRAINT FK_C9B9AD15BE3DB2B7');
        $this->addSql('DROP TABLE equipiers');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE etablissement_services');
        $this->addSql('DROP TABLE prestataire');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_services');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE user_prestataire');
        $this->addSql('ALTER TABLE "user" ADD role VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" DROP roles');
        $this->addSql('ALTER TABLE "user" RENAME COLUMN password TO mdp');
    }
}
