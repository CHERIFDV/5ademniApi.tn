<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230228214643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorys (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, for_service_id INT DEFAULT NULL, message VARCHAR(255) NOT NULL, INDEX IDX_5F9E962A7E3C61F9 (owner_id), INDEX IDX_5F9E962AA1C6452A (for_service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photos (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_876E0D9ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(30) NOT NULL, price INT NOT NULL, description VARCHAR(255) NOT NULL, latitude VARCHAR(255) NOT NULL, longitude VARCHAR(255) NOT NULL, state TINYINT(1) NOT NULL, INDEX IDX_E19D9AD27E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_categorys (service_id INT NOT NULL, categorys_id INT NOT NULL, INDEX IDX_AFFA4B7EED5CA9E6 (service_id), INDEX IDX_AFFA4B7EA96778EC (categorys_id), PRIMARY KEY(service_id, categorys_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(10) NOT NULL, last_name VARCHAR(10) NOT NULL, tel VARCHAR(8) NOT NULL, bio VARCHAR(255) DEFAULT NULL, type_profile TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE votes (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, iduser_id INT DEFAULT NULL, nub_star INT NOT NULL, INDEX IDX_518B7ACFED5CA9E6 (service_id), INDEX IDX_518B7ACF786A81FB (iduser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A7E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA1C6452A FOREIGN KEY (for_service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD27E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE service_categorys ADD CONSTRAINT FK_AFFA4B7EED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_categorys ADD CONSTRAINT FK_AFFA4B7EA96778EC FOREIGN KEY (categorys_id) REFERENCES categorys (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE votes ADD CONSTRAINT FK_518B7ACFED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE votes ADD CONSTRAINT FK_518B7ACF786A81FB FOREIGN KEY (iduser_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A7E3C61F9');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AA1C6452A');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D9ED5CA9E6');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD27E3C61F9');
        $this->addSql('ALTER TABLE service_categorys DROP FOREIGN KEY FK_AFFA4B7EED5CA9E6');
        $this->addSql('ALTER TABLE service_categorys DROP FOREIGN KEY FK_AFFA4B7EA96778EC');
        $this->addSql('ALTER TABLE votes DROP FOREIGN KEY FK_518B7ACFED5CA9E6');
        $this->addSql('ALTER TABLE votes DROP FOREIGN KEY FK_518B7ACF786A81FB');
        $this->addSql('DROP TABLE categorys');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE photos');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_categorys');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE votes');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
