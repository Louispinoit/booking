<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522122343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3319F34925F');
        $this->addSql('DROP INDEX IDX_CBE5A3319F34925F ON book');
        $this->addSql('ALTER TABLE book CHANGE id_categorie_id categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A331BCF5E72D ON book (categorie_id)');
        $this->addSql('ALTER TABLE loan DROP FOREIGN KEY FK_C5D30D0379F37AE5');
        $this->addSql('DROP INDEX IDX_C5D30D0379F37AE5 ON loan');
        $this->addSql('ALTER TABLE loan CHANGE id_user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE loan ADD CONSTRAINT FK_C5D30D03A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_C5D30D03A76ED395 ON loan (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331BCF5E72D');
        $this->addSql('DROP INDEX IDX_CBE5A331BCF5E72D ON book');
        $this->addSql('ALTER TABLE book CHANGE categorie_id id_categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3319F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_CBE5A3319F34925F ON book (id_categorie_id)');
        $this->addSql('ALTER TABLE loan DROP FOREIGN KEY FK_C5D30D03A76ED395');
        $this->addSql('DROP INDEX IDX_C5D30D03A76ED395 ON loan');
        $this->addSql('ALTER TABLE loan CHANGE user_id id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE loan ADD CONSTRAINT FK_C5D30D0379F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C5D30D0379F37AE5 ON loan (id_user_id)');
    }
}
