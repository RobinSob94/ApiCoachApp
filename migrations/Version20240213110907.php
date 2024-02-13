<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240213110907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etablissement_prestataire DROP CONSTRAINT fk_4794262cff631228');
        $this->addSql('ALTER TABLE etablissement_prestataire DROP CONSTRAINT fk_4794262cbe3db2b7');
        $this->addSql('DROP TABLE etablissement_prestataire');
        $this->addSql('ALTER TABLE etablissement ADD prestataire_id INT NOT NULL');
        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CBE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_20FD592CBE3DB2B7 ON etablissement (prestataire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE etablissement_prestataire (etablissement_id INT NOT NULL, prestataire_id INT NOT NULL, PRIMARY KEY(etablissement_id, prestataire_id))');
        $this->addSql('CREATE INDEX idx_4794262cbe3db2b7 ON etablissement_prestataire (prestataire_id)');
        $this->addSql('CREATE INDEX idx_4794262cff631228 ON etablissement_prestataire (etablissement_id)');
        $this->addSql('ALTER TABLE etablissement_prestataire ADD CONSTRAINT fk_4794262cff631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etablissement_prestataire ADD CONSTRAINT fk_4794262cbe3db2b7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etablissement DROP CONSTRAINT FK_20FD592CBE3DB2B7');
        $this->addSql('DROP INDEX IDX_20FD592CBE3DB2B7');
        $this->addSql('ALTER TABLE etablissement DROP prestataire_id');
    }
}
