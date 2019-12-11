<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use App\Entity\Priority;
use App\Entity\State;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191210225510 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('INSERT INTO state (id,name) VALUES (' . State::STATE_CLOSED . ', "Close")');
        $this->addSql('INSERT INTO state (name) VALUES ("Open")');

        $this->addSql('INSERT INTO priority (id,name) VALUES (' . Priority::STATE_HIGH . ', "High")');
        $this->addSql('INSERT INTO priority (name) VALUES ("Low")');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
