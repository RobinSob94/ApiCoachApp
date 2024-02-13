<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240213104653 extends AbstractMigration
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
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE services_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE equipiers (id INT NOT NULL, jours_travail TEXT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN equipiers.jours_travail IS \'(DC2Type:simple_array)\'');
        $this->addSql('CREATE TABLE equipiers_reservation (equipiers_id INT NOT NULL, reservation_id INT NOT NULL, PRIMARY KEY(equipiers_id, reservation_id))');
        $this->addSql('CREATE INDEX IDX_C68F5AEC9DF78FD7 ON equipiers_reservation (equipiers_id)');
        $this->addSql('CREATE INDEX IDX_C68F5AECB83297E7 ON equipiers_reservation (reservation_id)');
        $this->addSql('CREATE TABLE equipiers_etablissement (equipiers_id INT NOT NULL, etablissement_id INT NOT NULL, PRIMARY KEY(equipiers_id, etablissement_id))');
        $this->addSql('CREATE INDEX IDX_914489449DF78FD7 ON equipiers_etablissement (equipiers_id)');
        $this->addSql('CREATE INDEX IDX_91448944FF631228 ON equipiers_etablissement (etablissement_id)');
        $this->addSql('CREATE TABLE etablissement (id INT NOT NULL, nom_etablissement VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, heure�_open TIME(0) WITHOUT TIME ZONE NOT NULL, heure_close TIME(0) WITHOUT TIME ZONE NOT NULL, prix_h VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE etablissement_services (etablissement_id INT NOT NULL, services_id INT NOT NULL, PRIMARY KEY(etablissement_id, services_id))');
        $this->addSql('CREATE INDEX IDX_715B637CFF631228 ON etablissement_services (etablissement_id)');
        $this->addSql('CREATE INDEX IDX_715B637CAEF5A6C1 ON etablissement_services (services_id)');
        $this->addSql('CREATE TABLE etablissement_prestataire (etablissement_id INT NOT NULL, prestataire_id INT NOT NULL, PRIMARY KEY(etablissement_id, prestataire_id))');
        $this->addSql('CREATE INDEX IDX_4794262CFF631228 ON etablissement_prestataire (etablissement_id)');
        $this->addSql('CREATE INDEX IDX_4794262CBE3DB2B7 ON etablissement_prestataire (prestataire_id)');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, date_reservation DATE NOT NULL, note DOUBLE PRECISION NOT NULL, commentaire TEXT NOT NULL, heure_reservation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE services (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_reservation (user_id INT NOT NULL, reservation_id INT NOT NULL, PRIMARY KEY(user_id, reservation_id))');
        $this->addSql('CREATE INDEX IDX_EBD380C0A76ED395 ON user_reservation (user_id)');
        $this->addSql('CREATE INDEX IDX_EBD380C0B83297E7 ON user_reservation (reservation_id)');
        $this->addSql('CREATE TABLE user_prestataire (user_id INT NOT NULL, prestataire_id INT NOT NULL, PRIMARY KEY(user_id, prestataire_id))');
        $this->addSql('CREATE INDEX IDX_C9B9AD15A76ED395 ON user_prestataire (user_id)');
        $this->addSql('CREATE INDEX IDX_C9B9AD15BE3DB2B7 ON user_prestataire (prestataire_id)');
        $this->addSql('ALTER TABLE equipiers_reservation ADD CONSTRAINT FK_C68F5AEC9DF78FD7 FOREIGN KEY (equipiers_id) REFERENCES equipiers (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipiers_reservation ADD CONSTRAINT FK_C68F5AECB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipiers_etablissement ADD CONSTRAINT FK_914489449DF78FD7 FOREIGN KEY (equipiers_id) REFERENCES equipiers (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipiers_etablissement ADD CONSTRAINT FK_91448944FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etablissement_services ADD CONSTRAINT FK_715B637CFF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etablissement_services ADD CONSTRAINT FK_715B637CAEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etablissement_prestataire ADD CONSTRAINT FK_4794262CFF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etablissement_prestataire ADD CONSTRAINT FK_4794262CBE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_reservation ADD CONSTRAINT FK_EBD380C0A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_reservation ADD CONSTRAINT FK_EBD380C0B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
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
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE services_id_seq CASCADE');
        $this->addSql('ALTER TABLE equipiers_reservation DROP CONSTRAINT FK_C68F5AEC9DF78FD7');
        $this->addSql('ALTER TABLE equipiers_reservation DROP CONSTRAINT FK_C68F5AECB83297E7');
        $this->addSql('ALTER TABLE equipiers_etablissement DROP CONSTRAINT FK_914489449DF78FD7');
        $this->addSql('ALTER TABLE equipiers_etablissement DROP CONSTRAINT FK_91448944FF631228');
        $this->addSql('ALTER TABLE etablissement_services DROP CONSTRAINT FK_715B637CFF631228');
        $this->addSql('ALTER TABLE etablissement_services DROP CONSTRAINT FK_715B637CAEF5A6C1');
        $this->addSql('ALTER TABLE etablissement_prestataire DROP CONSTRAINT FK_4794262CFF631228');
        $this->addSql('ALTER TABLE etablissement_prestataire DROP CONSTRAINT FK_4794262CBE3DB2B7');
        $this->addSql('ALTER TABLE user_reservation DROP CONSTRAINT FK_EBD380C0A76ED395');
        $this->addSql('ALTER TABLE user_reservation DROP CONSTRAINT FK_EBD380C0B83297E7');
        $this->addSql('ALTER TABLE user_prestataire DROP CONSTRAINT FK_C9B9AD15A76ED395');
        $this->addSql('ALTER TABLE user_prestataire DROP CONSTRAINT FK_C9B9AD15BE3DB2B7');
        $this->addSql('DROP TABLE equipiers');
        $this->addSql('DROP TABLE equipiers_reservation');
        $this->addSql('DROP TABLE equipiers_etablissement');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE etablissement_services');
        $this->addSql('DROP TABLE etablissement_prestataire');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE user_reservation');
        $this->addSql('DROP TABLE user_prestataire');
        $this->addSql('ALTER TABLE "user" ADD role VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" DROP roles');
        $this->addSql('ALTER TABLE "user" RENAME COLUMN password TO mdp');
    }
}
