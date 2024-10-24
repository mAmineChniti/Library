<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241022152500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book_reader DROP FOREIGN KEY FK_E5E882B116A2B381');
        $this->addSql('ALTER TABLE book_reader DROP FOREIGN KEY FK_E5E882B11717D737');
        $this->addSql('DROP TABLE book_reader');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331F675F31B');
        $this->addSql('DROP INDEX IDX_CBE5A331F675F31B ON book');
        $this->addSql('ALTER TABLE book ADD author_id_id INT DEFAULT NULL, DROP author_id, CHANGE enabled enabled INT NOT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A33169CCBE9A FOREIGN KEY (author_id_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A33169CCBE9A ON book (author_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book_reader (book_id INT NOT NULL, reader_id INT NOT NULL, INDEX IDX_E5E882B116A2B381 (book_id), INDEX IDX_E5E882B11717D737 (reader_id), PRIMARY KEY(book_id, reader_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE book_reader ADD CONSTRAINT FK_E5E882B116A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_reader ADD CONSTRAINT FK_E5E882B11717D737 FOREIGN KEY (reader_id) REFERENCES reader (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A33169CCBE9A');
        $this->addSql('DROP INDEX IDX_CBE5A33169CCBE9A ON book');
        $this->addSql('ALTER TABLE book ADD author_id INT NOT NULL, DROP author_id_id, CHANGE enabled enabled TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_CBE5A331F675F31B ON book (author_id)');
    }
}
