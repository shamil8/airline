<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210420062528 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, total_amount INT DEFAULT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flight (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(55) NOT NULL, standard_price DOUBLE PRECISION NOT NULL, tickets_count INT NOT NULL, status INT DEFAULT NULL, if_flight_ticket_sales TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, booking_id_id INT DEFAULT NULL, flight_id_id INT NOT NULL, seat VARCHAR(5) NOT NULL, passanger_name VARCHAR(255) NOT NULL, phone VARCHAR(55) NOT NULL, UNIQUE INDEX UNIQ_97A0ADA3EE3863E2 (booking_id_id), INDEX IDX_97A0ADA3AC1354F1 (flight_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3EE3863E2 FOREIGN KEY (booking_id_id) REFERENCES booking (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3AC1354F1 FOREIGN KEY (flight_id_id) REFERENCES flight (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3EE3863E2');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3AC1354F1');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE flight');
        $this->addSql('DROP TABLE ticket');
    }
}
