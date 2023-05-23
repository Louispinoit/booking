<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522122013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, id_categorie_id INT NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, isbn INT NOT NULL, publicate_date DATETIME NOT NULL, INDEX IDX_CBE5A3319F34925F (id_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loan (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, INDEX IDX_C5D30D0379F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loan_book (loan_id INT NOT NULL, book_id INT NOT NULL, INDEX IDX_1A48D945CE73868F (loan_id), INDEX IDX_1A48D94516A2B381 (book_id), PRIMARY KEY(loan_id, book_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opinion (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_book_id INT DEFAULT NULL, notation INT NOT NULL, comment LONGTEXT NOT NULL, date_publish DATETIME NOT NULL, INDEX IDX_AB02B02779F37AE5 (id_user_id), INDEX IDX_AB02B027C83F1AF1 (id_book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE returns (id INT AUTO_INCREMENT NOT NULL, id_loan_id INT NOT NULL, date_return DATETIME NOT NULL, UNIQUE INDEX UNIQ_8B164CA510EE2FFF (id_loan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, firstname VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3319F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE loan ADD CONSTRAINT FK_C5D30D0379F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE loan_book ADD CONSTRAINT FK_1A48D945CE73868F FOREIGN KEY (loan_id) REFERENCES loan (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loan_book ADD CONSTRAINT FK_1A48D94516A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B02779F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B027C83F1AF1 FOREIGN KEY (id_book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE returns ADD CONSTRAINT FK_8B164CA510EE2FFF FOREIGN KEY (id_loan_id) REFERENCES loan (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3319F34925F');
        $this->addSql('ALTER TABLE loan DROP FOREIGN KEY FK_C5D30D0379F37AE5');
        $this->addSql('ALTER TABLE loan_book DROP FOREIGN KEY FK_1A48D945CE73868F');
        $this->addSql('ALTER TABLE loan_book DROP FOREIGN KEY FK_1A48D94516A2B381');
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B02779F37AE5');
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B027C83F1AF1');
        $this->addSql('ALTER TABLE returns DROP FOREIGN KEY FK_8B164CA510EE2FFF');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE loan');
        $this->addSql('DROP TABLE loan_book');
        $this->addSql('DROP TABLE opinion');
        $this->addSql('DROP TABLE returns');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
