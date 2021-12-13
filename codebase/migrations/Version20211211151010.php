<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20211211151010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adding foreign relation between expense_type and expenses tables';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf(
            'mysql' !== $this->connection->getDatabasePlatform()->getName(),
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql(<<<SQL
ALTER TABLE expenses ADD CONSTRAINT FK_TYPE_ID FOREIGN KEY (type_id) REFERENCES expense_types (id);
SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->abortIf(
            'mysql' !== $this->connection->getDatabasePlatform()->getName(),
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql(<<<SQL
ALTER TABLE expenses DROP CONSTRAINT FK_TYPE_ID;
SQL
        );
    }
}

