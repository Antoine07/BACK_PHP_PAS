<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220101816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pastry (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, origin JSON DEFAULT NULL, calory DOUBLE PRECISION DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, image VARCHAR(100) DEFAULT NULL, quantity SMALLINT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, score DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_pastry (user_id INT NOT NULL, pastry_id INT NOT NULL, INDEX IDX_6542F4B0A76ED395 (user_id), INDEX IDX_6542F4B04BFDB2A4 (pastry_id), PRIMARY KEY(user_id, pastry_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_pastry ADD CONSTRAINT FK_6542F4B0A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_pastry ADD CONSTRAINT FK_6542F4B04BFDB2A4 FOREIGN KEY (pastry_id) REFERENCES pastry (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_pastry DROP FOREIGN KEY FK_6542F4B0A76ED395');
        $this->addSql('ALTER TABLE user_pastry DROP FOREIGN KEY FK_6542F4B04BFDB2A4');
        $this->addSql('DROP TABLE pastry');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_pastry');
    }
}
