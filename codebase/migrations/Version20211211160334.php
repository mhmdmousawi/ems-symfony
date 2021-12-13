<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20211211160334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Inserting expense types into expense_types table';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf(
            'mysql' !== $this->connection->getDatabasePlatform()->getName(),
            'Migration can only be executed safely on \'mysql\'.'
        );

        $query = <<<SQL
INSERT INTO expense_types (name, created_at)
VALUES ('Entertainment', :now),
       ('Food', :now),
       ('Bills', :now),
       ('Transport', :now),
       ('Other', :now);
SQL;
        $this->addSql($query, ['now' => time()]);

    }

    public function down(Schema $schema): void
    {
        $this->abortIf(
            'mysql' !== $this->connection->getDatabasePlatform()->getName(),
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql(<<<SQL
DELETE FROM expense_types
WHERE name in ('Food', 'Bills', 'Transport', 'Other')
SQL
        );
    }
}
