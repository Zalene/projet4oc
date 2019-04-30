<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190430160412 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE billet ADD buyer_id INT NOT NULL');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF66C755722 FOREIGN KEY (buyer_id) REFERENCES buyer (id)');
        $this->addSql('CREATE INDEX IDX_1F034AF66C755722 ON billet (buyer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF66C755722');
        $this->addSql('DROP INDEX IDX_1F034AF66C755722 ON billet');
        $this->addSql('ALTER TABLE billet DROP buyer_id');
    }
}
