<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210814180811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, way_number VARCHAR(255) DEFAULT NULL, way VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, stage VARCHAR(255) DEFAULT NULL, apartment VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, siret VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_address (company_id INT NOT NULL, address_id INT NOT NULL, INDEX IDX_2D1C7556979B1AD6 (company_id), INDEX IDX_2D1C7556F5B7AF75 (address_id), PRIMARY KEY(company_id, address_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, document_id INT DEFAULT NULL, company_id INT DEFAULT NULL, company_address_id INT DEFAULT NULL, person_id INT DEFAULT NULL, person_address_id INT DEFAULT NULL, type_id INT NOT NULL, file_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, name_auto VARCHAR(255) DEFAULT NULL, job VARCHAR(255) DEFAULT NULL, date_limit DATE DEFAULT NULL, date_issue DATE DEFAULT NULL, date_start DATE DEFAULT NULL, date_end DATE DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', update_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', soft_delete TINYINT(1) DEFAULT NULL, cumulative_hour DOUBLE PRECISION DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, INDEX IDX_D8698A76C33F7837 (document_id), INDEX IDX_D8698A76979B1AD6 (company_id), INDEX IDX_D8698A76483946E3 (company_address_id), INDEX IDX_D8698A76217BBB47 (person_id), INDEX IDX_D8698A76C30CCC60 (person_address_id), INDEX IDX_D8698A76C54C8C93 (type_id), UNIQUE INDEX UNIQ_D8698A7693CB796C (file_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, extansion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE folder (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE folder_document (folder_id INT NOT NULL, document_id INT NOT NULL, INDEX IDX_11DC299C162CB942 (folder_id), INDEX IDX_11DC299CC33F7837 (document_id), PRIMARY KEY(folder_id, document_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, commonname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_address (person_id INT NOT NULL, address_id INT NOT NULL, INDEX IDX_2FD0DC08217BBB47 (person_id), INDEX IDX_2FD0DC08F5B7AF75 (address_id), PRIMARY KEY(person_id, address_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company_address ADD CONSTRAINT FK_2D1C7556979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_address ADD CONSTRAINT FK_2D1C7556F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76C33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76483946E3 FOREIGN KEY (company_address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76C30CCC60 FOREIGN KEY (person_address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7693CB796C FOREIGN KEY (file_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE folder_document ADD CONSTRAINT FK_11DC299C162CB942 FOREIGN KEY (folder_id) REFERENCES folder (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE folder_document ADD CONSTRAINT FK_11DC299CC33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person_address ADD CONSTRAINT FK_2FD0DC08217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person_address ADD CONSTRAINT FK_2FD0DC08F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company_address DROP FOREIGN KEY FK_2D1C7556F5B7AF75');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76483946E3');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76C30CCC60');
        $this->addSql('ALTER TABLE person_address DROP FOREIGN KEY FK_2FD0DC08F5B7AF75');
        $this->addSql('ALTER TABLE company_address DROP FOREIGN KEY FK_2D1C7556979B1AD6');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76979B1AD6');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76C33F7837');
        $this->addSql('ALTER TABLE folder_document DROP FOREIGN KEY FK_11DC299CC33F7837');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7693CB796C');
        $this->addSql('ALTER TABLE folder_document DROP FOREIGN KEY FK_11DC299C162CB942');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76217BBB47');
        $this->addSql('ALTER TABLE person_address DROP FOREIGN KEY FK_2FD0DC08217BBB47');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76C54C8C93');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE company_address');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE folder');
        $this->addSql('DROP TABLE folder_document');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE person_address');
        $this->addSql('DROP TABLE type');
    }
}
