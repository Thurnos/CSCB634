<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240608195009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attendance CHANGE date date DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE grades CHANGE grade grade VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE marks CHANGE mark mark VARCHAR(45) DEFAULT NULL, CHANGE date date DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE parents CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE number number VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE principals CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE schools CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE students CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE number number VARCHAR(45) DEFAULT NULL, CHANGE parent_ids parent_ids JSON NOT NULL');
        $this->addSql('ALTER TABLE subjects CHANGE name name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE teachers CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE username username VARCHAR(255) DEFAULT NULL, CHANGE password password VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attendance CHANGE date date DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE grades CHANGE grade grade VARCHAR(45) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE marks CHANGE mark mark VARCHAR(45) DEFAULT \'NULL\', CHANGE date date DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE parents CHANGE name name VARCHAR(255) DEFAULT \'NULL\', CHANGE email email VARCHAR(255) DEFAULT \'NULL\', CHANGE number number VARCHAR(45) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE principals CHANGE name name VARCHAR(255) DEFAULT \'NULL\', CHANGE email email VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE schools CHANGE name name VARCHAR(255) DEFAULT \'NULL\', CHANGE address address VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE students CHANGE name name VARCHAR(255) DEFAULT \'NULL\', CHANGE email email VARCHAR(255) DEFAULT \'NULL\', CHANGE number number VARCHAR(45) DEFAULT \'NULL\', CHANGE parent_ids parent_ids LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE subjects CHANGE name name VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE teachers CHANGE name name VARCHAR(255) DEFAULT \'NULL\', CHANGE email email VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE users CHANGE username username VARCHAR(255) DEFAULT \'NULL\', CHANGE password password VARCHAR(255) DEFAULT \'NULL\', CHANGE email email VARCHAR(255) DEFAULT \'NULL\'');
    }
}
