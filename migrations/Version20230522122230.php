<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522122230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B02779F37AE5');
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B027C83F1AF1');
        $this->addSql('DROP INDEX IDX_AB02B02779F37AE5 ON opinion');
        $this->addSql('DROP INDEX IDX_AB02B027C83F1AF1 ON opinion');
        $this->addSql('ALTER TABLE opinion CHANGE id_user_id user_id INT NOT NULL, CHANGE id_book_id book_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B027A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B02716A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('CREATE INDEX IDX_AB02B027A76ED395 ON opinion (user_id)');
        $this->addSql('CREATE INDEX IDX_AB02B02716A2B381 ON opinion (book_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B027A76ED395');
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B02716A2B381');
        $this->addSql('DROP INDEX IDX_AB02B027A76ED395 ON opinion');
        $this->addSql('DROP INDEX IDX_AB02B02716A2B381 ON opinion');
        $this->addSql('ALTER TABLE opinion CHANGE user_id id_user_id INT NOT NULL, CHANGE book_id id_book_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B02779F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B027C83F1AF1 FOREIGN KEY (id_book_id) REFERENCES book (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_AB02B02779F37AE5 ON opinion (id_user_id)');
        $this->addSql('CREATE INDEX IDX_AB02B027C83F1AF1 ON opinion (id_book_id)');
    }
}
