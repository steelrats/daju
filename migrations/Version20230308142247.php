<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308142247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE camera_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commentaires_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE drones_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE camera (id INT NOT NULL, drones_id INT DEFAULT NULL, ouverture DOUBLE PRECISION NOT NULL, resolution VARCHAR(255) NOT NULL, fov INT NOT NULL, stabilise BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3B1CEE05F7ABEBA0 ON camera (drones_id)');
        $this->addSql('CREATE TABLE commentaires (id INT NOT NULL, drones_id INT NOT NULL, auteur VARCHAR(255) NOT NULL, text VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D9BEC0C4F7ABEBA0 ON commentaires (drones_id)');
        $this->addSql('COMMENT ON COLUMN commentaires.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE drones (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prix INT NOT NULL, fabriquant VARCHAR(255) NOT NULL, resistance_vent VARCHAR(255) NOT NULL, poids INT NOT NULL, vitesse_horizon INT NOT NULL, vitesse_verticale INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE camera ADD CONSTRAINT FK_3B1CEE05F7ABEBA0 FOREIGN KEY (drones_id) REFERENCES drones (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C4F7ABEBA0 FOREIGN KEY (drones_id) REFERENCES drones (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE camera_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE commentaires_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE drones_id_seq CASCADE');
        $this->addSql('ALTER TABLE camera DROP CONSTRAINT FK_3B1CEE05F7ABEBA0');
        $this->addSql('ALTER TABLE commentaires DROP CONSTRAINT FK_D9BEC0C4F7ABEBA0');
        $this->addSql('DROP TABLE camera');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE drones');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
