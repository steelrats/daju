<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308150907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE commentaire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE commentaire (id INT NOT NULL, drones_id INT NOT NULL, auteur_id INT NOT NULL, text VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_67F068BCF7ABEBA0 ON commentaire (drones_id)');
        $this->addSql('CREATE INDEX IDX_67F068BC60BB6FE6 ON commentaire (auteur_id)');
        $this->addSql('COMMENT ON COLUMN commentaire.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCF7ABEBA0 FOREIGN KEY (drones_id) REFERENCES drones (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE camera DROP CONSTRAINT fk_3b1cee05f7abeba0');
        $this->addSql('DROP INDEX idx_3b1cee05f7abeba0');
        $this->addSql('ALTER TABLE camera DROP drones_id');
        $this->addSql('ALTER TABLE drones ADD camera_id INT NOT NULL');
        $this->addSql('ALTER TABLE drones ADD CONSTRAINT FK_513FE15BB47685CD FOREIGN KEY (camera_id) REFERENCES camera (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_513FE15BB47685CD ON drones (camera_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE commentaire_id_seq CASCADE');
        $this->addSql('ALTER TABLE commentaire DROP CONSTRAINT FK_67F068BCF7ABEBA0');
        $this->addSql('ALTER TABLE commentaire DROP CONSTRAINT FK_67F068BC60BB6FE6');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('ALTER TABLE drones DROP CONSTRAINT FK_513FE15BB47685CD');
        $this->addSql('DROP INDEX IDX_513FE15BB47685CD');
        $this->addSql('ALTER TABLE drones DROP camera_id');
        $this->addSql('ALTER TABLE camera ADD drones_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE camera ADD CONSTRAINT fk_3b1cee05f7abeba0 FOREIGN KEY (drones_id) REFERENCES drones (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_3b1cee05f7abeba0 ON camera (drones_id)');
    }
}
