<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181113083251 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE competences (id INT AUTO_INCREMENT NOT NULL, code INT NOT NULL, libelle VARCHAR(255) NOT NULL, nb_etudiants_max INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maison (id INT AUTO_INCREMENT NOT NULL, code INT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etudiant ADD maison_id INT DEFAULT NULL, ADD rue VARCHAR(100) DEFAULT NULL, ADD numrue VARCHAR(10) DEFAULT NULL, ADD copos INT DEFAULT NULL, ADD surnom VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E39D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (id)');
        $this->addSql('CREATE INDEX IDX_717E22E39D67D8AF ON etudiant (maison_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E39D67D8AF');
        $this->addSql('DROP TABLE competences');
        $this->addSql('DROP TABLE maison');
        $this->addSql('DROP INDEX IDX_717E22E39D67D8AF ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP maison_id, DROP rue, DROP numrue, DROP copos, DROP surnom');
    }
}
